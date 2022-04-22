<?php


namespace Modules\Order\Helpers;


use Illuminate\Support\Facades\Cache;

class CartApiManagement extends CartManager
{
    protected static $_cart_id;

    public static function cart_id(){

        if(!static::$_cart_id) static::$_cart_id = request('cart_id');
        if(!static::$_cart_id) static::$_cart_id = 'cart_'.md5(uniqid().rand(0,9999999));

        return static::$_cart_id;

    }

    public static function save()
    {
        Cache::put(static::cart_id(),static::items()->toArray());
    }

    protected static function rawItems()
    {
        return Cache::get(static::cart_id(),[]);
    }
}
