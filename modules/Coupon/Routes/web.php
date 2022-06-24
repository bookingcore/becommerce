<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'coupon'],function(){
    Route::post('/{code}/apply','CouponController@applyCoupon')->name('coupon.apply');
    Route::post('/{code}/remove','CouponController@removeCoupon')->name('coupon.remove');
});
