<?php


namespace Modules\Order\Helpers;

use Illuminate\Support\Collection;
use Modules\Coupon\Models\Coupon;
use Modules\Coupon\Models\CouponOrder;
use Modules\Order\Models\CartItem;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Modules\Product\Models\Product;

class CartManager
{
    protected static $session_key='bc_carts';

    protected static $session_coupon_key = 'bc_coupon_cart';

    /**
     * @var array | Collection
     */
    protected static $_items = [];

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
            $item->qty += 1;
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

       return static::items()->find($cartItemId);
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

        $items = static::items();
        $find = $items->where('id',$cart_item_id)->first();
        if($find){
            $find->qty = $qty;
            if(!empty($price)){
                $find->price = $price;
            }
            if(!empty($variation_id)){
                $find->variation_id = $variation_id;
            }
            if(!empty($meta)){
                $find->meta = $meta;
            }

            if($qty <= 0){
                return static::remove($cart_item_id);
            }else{
                $items->put($cart_item_id,$find);
                static::save();
            }

            return $find;
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
        session()->remove(static::$session_key);
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
        return static::items()->sum('discount_amount');
    }
    public static function shippingTotal(){
        return static::items()->sum('shipping_amount');
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
        return $subTotal + $shipping - $discount;
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
		    static::updateItemCoupon($coupon);
		    session()->put(static::$session_coupon_key,$coupons);
	    }
    }
    public static function removeCounpon(Coupon $coupon){
    	if(!empty($coupon->id)){
		    $coupons = static::getCoupon();
		    $coupons->pull($coupon->id);
		    static::updateItemCoupon($coupon,'remove');
		    session()->put(static::$session_coupon_key,$coupons);
	    }
    }

	public static function updateItemCoupon(Coupon $coupon,$action='add'){
		$items = static::items();
		if(!empty($items)){
			if(!empty($coupon->services)){
                $services  = $coupon->services->pluck(['object_id','object_model'])->toArray();
                foreach ($items as $cart_item_id=> $item){
                    $check = \Arr::where($services,function ($value,$key) use ($item){
                        if($value['object_id']==$item['object_id'] and $value['object_model'] == $item['object_model']){
                            return $value;
                        }
                    });
                    if(!empty($check)){
                        if($action=='remove'){
                            $item->discount_amount = $item->discount_amount - $coupon->calculatorPrice($item->price);
                        }else{
                            $item->discount_amount = $item->discount_amount + $coupon->calculatorPrice($item->price);
                        }
                        if($item->discount_amount < 0){
                            $item->discount_amount = 0;
                        }
                        $items->put($cart_item_id,$item);
                        static::save();
                    }
                }
            }else{
                foreach ($items as $cart_item_id=> $item){
                        if($action=='remove'){
                            $item->discount_amount = $item->discount_amount - $coupon->calculatorPrice($item->price);
                        }else{
                            $item->discount_amount = $item->discount_amount + $coupon->calculatorPrice($item->price);
                        }
                        if($item->discount_amount < 0){
                            $item->discount_amount = 0;
                        }
                        $items->put($cart_item_id,$item);
                        static::save();
                }
            }
		}

	}

    public static function clearCoupon(){
    	session()->forget(static::$session_coupon_key);
    }


    /**
     * return Order
     */
    public static function order(){
        $order = new Order();
        $order->customer_id = auth()->id();
        $order->status = Order::DRAFT;
        $order->locale = app()->getLocale();
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
            $order_item->locale = app()->getLocale();
            $order_item->save();
        }
        $order->syncTotal();

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

}
