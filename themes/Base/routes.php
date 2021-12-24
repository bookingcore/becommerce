<?php
use \Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('home');
Route::get('/product','ProductController@index')->name('product.index');


Route::group(['prefix'=>'user'],function(){
   Route::get('/order','UserController@order')->name('user.order.index');
});
