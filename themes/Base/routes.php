<?php
use \Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('home');
Route::get('/product','ProductController@index')->name('product.index');
Route::get('/category/{slug}','ProductController@categoryIndex')->name('product.category.index');


Route::group(['prefix'=>'user','middleware'=>'auth'],function(){
   Route::get('/order','User\OrderController@index')->name('user.order.index');
   Route::get('/order/{id}','User\OrderController@detail')->name('user.order.detail');
   Route::get('/address','User\AddressController@index')->name('user.address.index');
   Route::get('/address/{type}','User\AddressController@detail')->name('user.address.detail');
   Route::post('/address/{type}/store','User\AddressController@store')->name('user.address.store');
});

Route::group(['prefix'=>'pos'],function(){
   Route::get('/','POSController@index')->name('pos');
});
