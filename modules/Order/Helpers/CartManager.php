<?php


namespace Modules\Order\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Coupon\Models\Coupon;
use Modules\Coupon\Models\CouponOrder;
use Modules\Order\Models\Cart;
use Modules\Order\Models\CartItem;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Modules\Product\Models\Product;
use Modules\Product\Models\ShippingZone;
use Modules\Product\Models\ShippingZoneLocation;
use Modules\Product\Models\ShippingZoneMethod;
use Modules\Product\Models\TaxRate;

class CartManager
{

    protected static $session_key='bc_cart_id';

    protected static $_cart;


    /**
     * @return Cart
     */
    public static function cart($create_draft = false){

        if(!static::$_cart){
            $cart_id = static::cart_id();
            if($cart_id){
                $cart = Cart::find($cart_id);
                if(!$cart){
                    static::clear();
                }
            }
            if(empty($cart)){
                if($create_draft){
                    $cart = Cart::createDraft();
                    session(static::$session_key,$cart->id);
                }else{
                    return null;
                }
            }
            static::$_cart = $cart;
        }

        return static::$_cart;
    }

    public static function add($product_id, $name = '', $qty = 1, $price = 0,$meta = [], $variation_id = false){

        static::cart(true);

        $item = static::findItem($product_id,$variation_id);
        if(!$item){
            if ($product_id instanceof Product){
                $item = CartItem::fromProduct($product_id,$qty,$price,$meta, $variation_id);
            }else{
                $item = CartItem::fromAttribute($product_id,$name,$qty,$price, $meta, $variation_id);
            }
            static::pushItem($item);
        }else{

            $item->qty += $qty;

            $item->updatePrice();
        }

        return $item;
    }

    /**
     * Get Cart Item by ID
     *
     * @param int $cartItemId
     * @return CartItem|null|mixed
     */
    public static function item($cartItemId){

       return static::cart()->items()->where('id',$cartItemId)->first();
    }

    /**
     * Get Cart Item by Product ID and Variation ID
     *
     * @param int|Product $product_id
     * @param int|false $variation_id
     * @return CartItem|null
     */
    public static function findItem($product_id, $variation_id = false){

        $currentItems  = static::cart()->items();

        if($product_id instanceof Product){
            $currentItems = $currentItems->where('product_id',$product_id->id);
        }else{
            $currentItems = $currentItems->where('product_id',$product_id);
        }
        if($variation_id){
            $currentItems = $currentItems->where('variation_id',$variation_id);
        }
        return $currentItems->first();
    }

    /**
     * Update Cart Item
     *
     * @param $cart_item_id
     * @param int $qty
     * @param false $price
     * @param false $variation_id
     * @return bool|Collection|null
     */
    public static function update($cart_item_id,$qty = 1,$price = false, $meta = [], $variation_id = false){

        $find = static::item($cart_item_id);
        if($find){
            $find->qty = $qty;

            if($qty <= 0){
                return static::remove($cart_item_id);
            }
        }

        return null;
    }

    /**
     * Remove cart item by id
     *
     * @param $cart_item_id
     * @return boolean
     *
     */
    public static function remove($cart_item_id){
        static::cart()->items()->where('id',$cart_item_id)->delete();
        static::cart()->load('items');
        return true;
    }

    /**
     * @return bool
     */
    public static function clear(){
        if($cart = static::cart()){
            $cart->delete();
        }
        Session::forget(static::$session_key);
        static::$_cart = null;
        return true;
    }

    /**
     * Get Cart Items
     *
     * @return CartItem[]
     */
    public static function items(){

        return static::cart()->items ?? [];
    }

    /**
     * Return number of cart items
     *
     * @return int
     */
    public static function count(){
        return count(static::items());
    }

    /**
     * Get Subtotal
     *
     * @return float
     */
    public static function subtotal(){
        return static::cart()->subtotal();
    }

    public static function discountTotal(){
        return static::cart()->discountTotal();
    }

    public static function shippingTotal(){
        return static::cart()->shippingTotal();
    }

    /**
     * Get Subtotal
     *
     * @return float
     */
    public static function total(){
        return static::cart()->total;
    }

    public static function fragments(){
        return [
            '.header_content .bc-mini-cart'=>view('order.cart.mini-cart')->render(),
        ];
    }

    public static function getCoupon(){
    	return collect(static::cart()->getJsonMeta('coupons'));
    }

    public static function storeCoupon(Coupon $coupon){
    	if(!empty($coupon->id)){
		    $coupons = static::getCoupon();
		    $coupons->put($coupon->id,$coupon);

		    static::cart()->addMeta('coupons',$coupons);

		    static::calculatorDiscountCoupon();
	    }
    }
    public static function removeCounpon(Coupon $coupon){
    	if(!empty($coupon->id)){
		    $coupons = static::getCoupon();
		    $coupons->pull($coupon->id);
		    static::calculatorDiscountCoupon();

            static::cart()->addMeta('coupons',$coupons);
	    }
    }

	public static function calculatorDiscountCoupon()
    {
		$items = static::items();
		$coupons  = static::getCoupon();
		$totalDiscount = 0;
        $resetDiscount =true ;
		if(!empty($items) and $coupons->count()>0){
		    foreach ($coupons as $c=> $coupon){
                $coupon = Coupon::find($coupon['id']);
                if(!empty($coupon)){
                    $services = $coupon->services()->get(['object_id','object_model'])->toArray();
                    if(!empty($services)){
                        foreach ($items as $cart_item_id=> $item){
                            $check = \Arr::where($services,function ($value,$key) use ($item){
                                if($value['object_id']==$item['object_id'] and $value['object_model'] == $item['object_model']){
                                    return $value;
                                }
                            });
                            if(!empty($check)){
                                $discount = $coupon->calculatorPrice($item->price);
                                if($resetDiscount){
                                    //reset discount_amount
                                    $item->discount_amount =0;
                                }
                                $item->discount_amount+=$discount;
                                $items->put($cart_item_id,$item);
                                $totalDiscount += $discount;
                            }
                        }
                    }else{
                        $totalDiscount += $coupon->calculatorPrice(static::subtotal());
                    }
                }
                $resetDiscount = false;
            }
		}
		if($totalDiscount<0){
		    $totalDiscount = 0;
        }
		static::cart()->total_discount = $totalDiscount;
	}

    /**
     * return Order
     */
    public static function order(Request $request){

        $shipping_country = $request->input($request->input('shipping_same_address') ? 'billing_country' : 'shipping_country');
        // CartManager add shipping
        if($res = CartManager::addShipping( $shipping_country ,$request->input("shipping_method_id"))){
            if($res['status'] == 0){
                throw new \Exception($res['message'] ?? __("Can not add shipping"));
            }
        }

        CartManager::addTax($request->input('billing_country') , $request->input('shipping_country'));

        $order = static::cart();
        $order->customer_id = auth()->id();
        $order->status = Order::DRAFT;
        $order->locale = app()->getLocale();
        $order->shipping_amount = static::cart()->shipping_amount;
        $order->discount_amount = static::discountTotal();
        $order->gateway = $request->input('payment_gateway');
        $order->save();

        $items = static::items();
        foreach ($items as $order_item){
            $model = $order_item->model;
            if(!$model){
                $order_item->delete();
                throw new \Exception(__("Product: :id does not exists",['id'=>$order_item->object_id]));
            }
            $order_item->price = $model->sale_price;
            $order_item->locale = app()->getLocale();
            $order_item->calculateTotal();
            $order_item->calculateCommission();
            $order_item->save();
        }
        $order->syncTotal();

        //Tax
        if(!empty( $taxItems = static::cart()->tax )){
            $tax_rate = 0;
            foreach ( $taxItems as $item ){
                $tax_rate += $item['tax_rate'];
            }
            $total_amount = $order->total;
            $tax_amount = ( $total_amount / 100 ) * $tax_rate;
            if(setting_item("prices_include_tax", 'yes') == "no"){
                $total_amount += $tax_amount;
            }
            $order->total = $total_amount;
            $order->tax_amount = $tax_amount;
            $order->save();
            $order->addMeta('prices_include_tax',setting_item("prices_include_tax", 'yes'));
        }

        $coupons = static::getCoupon();

        if(!empty($coupons) and count($coupons)>0){
            foreach ($coupons as $coupon){
                $couponOrder = new CouponOrder();
                $couponOrder->order_id = $order->id;
                $couponOrder->order_status = Order::DRAFT;
                $couponOrder->coupon_code = $coupon['code'];
                $couponOrder->coupon_amount = $coupon['amount'];
                $couponOrder->coupon_discount_type = $coupon['discount_type'];
                $couponOrder->coupon_data = $coupon;
                $couponOrder->save();
            }
        }

        return $order;
    }

    public static function pushItem(CartItem $cartItem){
        static::cart()->items()->save($cartItem);
    }


    public static function validate(){
        foreach (static::items() as $item){
            $model = $item->model;
            if($model){
                $model->addToCartValidate($item->qty,$item->variation_id);
            }
        }
    }
    public static function validateItem(CartItem $item,$qty){
        $model = $item->model;
        if($model){
            $model->addToCartValidate($qty,$item->variation_id);
        }
        return true;
    }

    public static function getMethodShipping($country){
        $data = [
            'status' => 0,
            'shipping_methods' => [],
            'message' => __("There are no shipping options available."),
        ];
        $shipping_methods = [];
        // Method for country
        $zone_location = ShippingZoneLocation::where("location_code",$country)->first();
        if(!empty($zone_location)) {
            $zone = ShippingZone::find($zone_location->zone_id);
            $shipping_methods = $zone->shippingMethodsAvailable;
        }elseif(!empty($shipping_methods_default = ShippingZoneMethod::where("zone_id",0)->where('is_enabled',1)->orderBy("order","asc")->get())){
            // Method default
            $shipping_methods = $shipping_methods_default;
        }
        if(!empty($shipping_methods)){
            foreach ( $shipping_methods as $method){
                $translate = $method->translate();
                $data['status'] = 1;
                $data['message'] = "";
                $data['shipping_methods'][] = [
                    'method_id'=>$method->id,
                    'method_title'=>$translate->title,
                    'method_cost'=>$method->cost,
                ];
            }
        }
        return $data;
    }

    public static function addShipping($country , $shipping_method){
        // if no method setting
        if( ShippingZoneMethod::countMethodAvailable() == 0){
            return ['status'=>1];
        }
        // find method in zone
        if(empty($shipping_method)){
            return ['status'=>0,'message'=>'Please select shipping method.'];
        }
        $list_methods = static::getMethodShipping($country);
        if(!empty($list_methods['shipping_methods']))
        {
            foreach ( $list_methods['shipping_methods'] as $method){
                if($method['method_id'] == $shipping_method){
                    static::cart()->shipping_amount = $method['method_cost'];
                    static::cart()->shipping_method = $method;
                    return ['status'=>1];
                }
            }
            static::cart()->save();
        }
        // if method not in zone
        return ['status'=>0,'message'=>'There are no shipping options available.'];
    }

    public static function getTaxRate($billing_country , $shipping_country)
    {
        $data = [
            'status' => 0,
            'tax'    => ''
        ];
        switch ( setting_item("tax_based_on",'billing') )
        {
            case"billing":
                $country = $billing_country;
                break;
            case"shipping":
                $country = $shipping_country;
                break;
            default:
                $country = "";
        }
        // Find Tax By Country
        $tax = TaxRate::select("id","name", "tax_rate", "city", "postcode", "country", "state")
            ->where("country", $country)
            ->orWhere("country", "*")->get();
        if (!empty($tax)) {
            $data = [
                'status'             => 1,
                'prices_include_tax' => setting_item("prices_include_tax", 'yes'),
                'tax'                => $tax->toArray(),
            ];
        }
        return $data;
    }

    public static function addTax($billing_country , $shipping_country){
        if( TaxRate::isEnable() ){
            $tax = static::getTaxRate($billing_country , $shipping_country);
            if(!empty($tax['tax'])){
                static::cart()->addMeta('tax',$tax['tax']);
            }
        }
    }

    public static function cart_id(){
        return session(static::$session_key);
    }
}
