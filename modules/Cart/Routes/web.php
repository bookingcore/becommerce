<?php
use \Illuminate\Support\Facades\Route;
Route::group(['prefix'=>'cart'],function(){
    Route::get('/','CartController@index')->name('cart.index');
    Route::post('/add','CartController@add')->name('cart.add');
    Route::get('/remove/{id}','CartController@removeItem')->name('cart.remove');
});