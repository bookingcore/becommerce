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
                    session([static::$session_key => $cart->id]);
                }else{
                    return new Cart();
                }
            }
            static::$_cart = $cart;
        }

        return static::$_cart;
    }

    public static function add($product_id, $name = '', $qty = 1, $price = 0,$meta = [], $variation_id = false){

        $cart = static::cart(true);

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
            $currentItems = $currentItems->where('object_id',$product_id->id);
        }else{
            $currentItems = $currentItems->where('object_id',$product_id);
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

    /**
     * @return Coupon[]|mixed
     */
    public static function getCoupon(){
    	return static::cart()->coupons;
    }

    public static function storeCoupon(Coupon $coupon){
    	return static::cart()->storeCoupon($coupon);
    }
    public static function removeCoupon(Coupon $coupon){

        return static::cart()->removeCoupon($coupon);
    }


    public static function pushItem(CartItem $cartItem){
        static::cart()->addItem($cartItem);
    }


    public static function validate(){
        return static::cart()->validate();
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
        $res = static::cart()->addShipping($country,$shipping_method);

        static::cart()->save();

        return $res;
    }

    public static function getTaxRate($billing_country , $shipping_country)
    {
        return static::cart()->getTaxRate($billing_country , $shipping_country);
    }

    public static function addTax($billing_country , $shipping_country){
        return static::cart()->addTax($billing_country,$shipping_country);
    }

    public static function cart_id(){
        return session(static::$session_key);
    }
}
