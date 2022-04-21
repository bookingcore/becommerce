<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/v1/'],function(){
    Route::post('/cart/addToCart','V1\CartController@addToCart')->name('cart.api.addToCart');
});
