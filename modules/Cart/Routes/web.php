<?php
use \Illuminate\Support\Facades\Route;
Route::group(['prefix'=>'cart'],function(){
    Route::post('/add','CartController@add')->name('cart.add');
});