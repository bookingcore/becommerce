<?php


namespace Modules\Order\Helpers;


use Illuminate\Support\Facades\Cache;

class CartApiManagement extends CartManager
{
    protected static $_cart_id;

    public static function cart_id(){

        if(!static::$_cart_id) static::$_cart_id = request('cart_id');
        if(!static::$_cart_id) static::$_cart_id = 'cart_'.rand(0,999).uniqid().rand(0,999);

        return static::$_cart_id;

    }

    protected static function rawData()
    {
        return Cache::get(static::cart_id(),[]);
    }

    public static function save()
    {
        return Cache::put(static::cart_id(),static::cart()->toArray());
    }
}
