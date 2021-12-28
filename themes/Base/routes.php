<?php
use \Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('home');
Route::get('/product','ProductController@index')->name('product.index');
Route::get('/category/{slug}','ProductController@categoryIndex')->name('product.category.index');


Route::group(['prefix'=>'user','middleware'=>'auth'],function(){
   Route::get('/order','UserController@order')->name('user.order.index');
});

Route::group(['prefix'=>'pos'],function(){
   Route::get('/','POSController@index')->name('pos');
});
