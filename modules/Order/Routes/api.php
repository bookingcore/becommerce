<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/v1/'],function(){


    Route::group(['prefix'=>'cart'],function(){

        Route::post('/addToCart','V1\CartController@addToCart')->name('cart.api.addToCart');

        Route::post('/remove_cart_item','V1\CartController@removeCartItem')->name('cart.api.remove_cart_item');
        Route::post('/update','V1\CartController@updateCartItem')->name('cart.api.update_cart_item');

        // Coupon
        Route::post('/apply_coupon','V1\CouponController@applyCoupon')->name('cart.api.coupon.apply');
        Route::post('/remove_coupon','V1\CouponController@removeCoupon')->name('cart.api.coupon.remove');
        //Shipping
        Route::post('/get_shipping_method','V1\CartController@getShippingMethod')->name('cart.api.shipping.get_method');

        //Tax
        Route::post('/get_tax_rate','V1\CartController@getTaxRate')->name('cart.api.shipping.get_method');

        Route::get('/detail/{code}','V1\CartController@detail')->name('cart.api.detail');
    });

    Route::group(['prefix'=>'checkout'],function(){
        Route::get('/{code}','V1\CheckoutController@index')->name('checkout.api.index');
        Route::post('/{code}/process','V1\CheckoutController@process')->name('checkout.api.process');
    });
});
