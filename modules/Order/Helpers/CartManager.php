<?php


namespace Modules\Order\Helpers;

use Illuminate\Support\Collection;
use Modules\Booking\Models\Bookable;
use Modules\Coupon\Models\Coupon;
use Modules\Order\Models\CartItem;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductLicense;

class CartManager
{
    protected static $session_key='core_carts';

    protected static $session_coupon_key = 'core_coupon_cart';

    public static function add($product_id, $name = '', $qty = 1, $price = 0,$meta = [], $variant_id = false){

        $items = static::items();
        $item = static::item($product_id,$variant_id);
        if(!$item){
            if($product_id instanceof Bookable){
                $item = CartItem::fromModel($product_id,$qty,$price,$meta, $variant_id);
            }elseif ($product_id instanceof Product){
                $item = CartItem::fromProduct($product_id,$qty,$price,$meta, $variant_id);

            }else{
                $item = CartItem::fromAttribute($product_id,$name,$qty,$price, $meta, $variant_id);
            }
            $items->put($item->id, $item);

        }else{
            $item->qty = $qty;
            $item->price = $price;
        }

        session()->put(static::$session_key, $items);

        return $item;
    }

    /**
     * Get Cart Item by Product ID (Or Bookable) and Variation ID
     *
     * @param int|Bookable $product_id
     * @param false $variant_id
     * @return CartItem|null
     */
    public static function item($product_id, $variant_id = false){

        $currentItems  = static::items();
        if($product_id instanceof Bookable){
            $items =  $currentItems->where('product_id',$product_id->id);
        }
        elseif($product_id instanceof Product){
            $items =  $currentItems->where('product_id',$product_id->id);
        }else{
            $items =  $currentItems->where('product_id',$product_id);
        }
        if($variant_id){
            $items->where('variant_id',$variant_id);
        }
        return $items->first();
    }

    /**
     * Update Cart Item
     *
     * @param $cart_item_id
     * @param int $qty
     * @param false $price
     * @param false $variant_id
     * @return bool|Collection|null
     */
    public static function update($cart_item_id,$qty = 1,$price = false, $meta = [], $variant_id = false){

        $items = static::items();
        $find = $items->where('id',$cart_item_id)->first();
        if($find){
            $find->qty = $qty;
            if(!empty($price)){
                $find->price = $price;
            }
            if(!empty($variant_id)){
                $find->variant_id = $variant_id;
            }
            if(!empty($meta)){
                $find->meta = $meta;
            }

            if($qty <= 0){
                return static::remove($cart_item_id);
            }else{
                $items->put($cart_item_id,$find);
                session()->put(static::$session_key, $items);
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

        $items = static::items();
        $items->pull($cart_item_id);
        session()->put(static::$session_key, $items);

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
        $items = session()->get(static::$session_key);
        if(!$items or !$items instanceof Collection){
            return new Collection([]);
        }
        return $items;
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

    public static function get_cart_fragments(){
        return [
            '.header__content .bc-mini-cart'=>view('order.cart.mini-cart')->render(),
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
                        session()->put(static::$session_key, $items);
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
                        session()->put(static::$session_key, $items);
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
        $order->status = 'draft';
        $order->save();

        $items = static::items();
        foreach ($items as $item){
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->object_id = $item->model->id;
            $order_item->object_model = $item->model->type;
            $order_item->price = $item->price;
            $order_item->qty = $item->qty;
            $order_item->subtotal = $item->subtotal;
            $order_item->status = 'draft';
            $order_item->meta = $item->meta;
            $order_item->save();

        }
        $order->syncTotal();
        return $order;
    }



}
