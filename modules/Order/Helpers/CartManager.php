<?php


namespace Modules\Order\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Coupon\Models\Coupon;
use Modules\Coupon\Models\CouponOrder;
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
    protected static $session_key='bc_carts';

    protected static $session_coupon_key = 'bc_coupon_cart';
    protected static $session_total_discount_key = 'bc_total_discount';

    /**
     * @var array | Collection
     */
    protected static $_items = [];
    public static $_shipping_amount = 0;
    public static $_discount_total = 0;
    public static $_shipping_method = [];
    public static $_tax = [];

    public static function add($product_id, $name = '', $qty = 1, $price = 0,$meta = [], $variation_id = false){

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

            static::save();;
        }

        return $item;
    }

    /**
     * Get Cart Item by ID
     *
     * @param int $cartItemId
     * @return CartItem|null
     */
    public static function item($cartItemId){

       return static::items()->where('id',$cartItemId)->first();
    }

    /**
     * Get Cart Item by Product ID and Variation ID
     *
     * @param int|Product $product_id
     * @param int|false $variation_id
     * @return CartItem|null
     */
    public static function findItem($product_id, $variation_id = false){

        $currentItems  = static::items();

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
            }else{
                static::save();
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

        $removed = static::items()->reject(function($item) use ($cart_item_id){
            return $item->id == $cart_item_id;
        });
        static::$_items = $removed;
        static::save();

        return true;

    }

    /**
     * @return bool
     */
    public static function clear(){
        Session::forget(static::$session_key);
//        session()->forget(static::$session_key);
        return true;
    }


    /**
     * Get Cart Items
     *
     * @return Collection
     */
    public static function items(){

        if(!empty(static::$_items)){
            return static::$_items;
        }

        $raw = static::rawItems();
        $items = collect();
        foreach ($raw as $rawItem){
            if(isset($rawItem['model'])) unset($rawItem['model']);
            $cartItem = new CartItem();

            foreach ($rawItem as $k=>$v){
                $cartItem->setAttribute($k,$v);
            }
            $items->push($cartItem);
        }

        static::$_items = $items;
        return static::$_items;
    }

    protected static function rawItems(){
        $items = session()->get(static::$session_key);
        return $items ?? [];
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
        return static::items()->sum('subtotal');
    }

    public static function discountTotal(){
        return \session()->get(static::$session_total_discount_key);
    }
    public static function shippingTotal(){
        return static::items()->sum('shipping_amount') + static::$_shipping_amount;
    }

    /**
     * Get Subtotal
     *
     * @return float
     */
    public static function total(){
        $subTotal = static::subtotal();
        $discount = static::discountTotal();
        $shipping = static::shippingTotal();
        $total = $subTotal + $shipping - $discount;
        return $total>=0?$total:0;
    }

    public static function fragments(){
        return [
            '.header_content .bc-mini-cart'=>view('order.cart.mini-cart')->render(),
        ];
    }




    public static function getCoupon(){
    	return session()->get(static::$session_coupon_key,new Collection([]));
    }

    public static function storeCoupon(Coupon $coupon){
    	if(!empty($coupon->id)){
		    $coupons = static::getCoupon();
		    $coupons->put($coupon->id,$coupon);
		    static::calculatorDiscountCoupon();
		    session()->put(static::$session_coupon_key,$coupons);
	    }
    }
    public static function removeCounpon(Coupon $coupon){
    	if(!empty($coupon->id)){
		    $coupons = static::getCoupon();
		    $coupons->pull($coupon->id);
		    static::calculatorDiscountCoupon();
		    session()->put(static::$session_coupon_key,$coupons);
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
//                              reset discount_amount
                                $item->discount_amount =0;
                            }
                            $item->discount_amount+=$discount;
                            $items->put($cart_item_id,$item);
                            static::save();
                            $totalDiscount += $discount;
                        }
                    }
                }else{
                    $totalDiscount += $coupon->calculatorPrice(static::subtotal());
                }
                $resetDiscount = false;
            }

		}
		if($totalDiscount<0){
		    $totalDiscount = 0;
        }
		\session()->put(static::$session_total_discount_key,$totalDiscount);

	}

    public static function clearCoupon(){
//    	session()->forget(static::$session_coupon_key);
        Session::forget(static::$session_coupon_key);
    }


    /**
     * return Order
     */
    public static function order(){
        $order = new Order();
        $order->customer_id = auth()->id();
        $order->status = Order::DRAFT;
        $order->locale = app()->getLocale();
        $order->shipping_amount = static::$_shipping_amount;
        $order->discount_amount = static::discountTotal();
        $order->save();

        $items = static::items();
        foreach ($items as $item){
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->object_id = $item->model->id;
            $order_item->object_model = $item->model->type;
            $order_item->price = $item->price;
            $order_item->discount_amount = $item->discount_amount;
            $order_item->qty = $item->qty;
            $order_item->subtotal = $item->subtotal;
            $order_item->status = Order::DRAFT;
            $order_item->meta = $item->meta;
            $order_item->variation_id = $item->variation_id;
            $order_item->vendor_id = $item->author_id;
            $order_item->locale = app()->getLocale();
            $order_item->save();
        }
        $order->syncTotal();

        //Tax
        if(!empty( static::$_tax )){
            $tax_rate = 0;
            foreach ( static::$_tax as $item ){
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
            $order->addMeta('tax',static::$_tax);
            $order->addMeta('prices_include_tax',setting_item("prices_include_tax", 'yes'));
        }

        $coupons = static::getCoupon();
        if(!empty($coupons) and count($coupons)>0){
            foreach ($coupons as $coupon){
                $couponOrder = new CouponOrder();
                $couponOrder->order_id = $order->id;
                $couponOrder->order_status = Order::DRAFT;
                $couponOrder->coupon_code = $coupon->code;
                $couponOrder->coupon_amount = $coupon->amount;
                $couponOrder->coupon_discount_type = $coupon->discount_type;
                $couponOrder->coupon_data = $coupon->toArray();
                $couponOrder->save();
            }
        }

        return $order;
    }

    public static function pushItem($cartItem){
        static::items()->push($cartItem);
        static::save();
    }

    public static function save(){
        session()->put(static::$session_key, static::items()->toArray());
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
                    static::$_shipping_amount = $method['method_cost'];
                    static::$_shipping_method = $method;
                    return ['status'=>1];
                }
            }
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
        $tax = TaxRate::select("name", "tax_rate", "city", "postcode", "country", "state")
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
        if( TaxRate::taxEnable() ){
            $tax = static::getTaxRate($billing_country , $shipping_country);
            if(!empty($tax['tax'])){
                static::$_tax = $tax['tax'];
            }
        }
    }
}
