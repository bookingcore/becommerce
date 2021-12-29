<?php
use \Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('home');
Route::get('/product','ProductController@index')->name('product.index');
Route::get('/category/{slug}','ProductController@categoryIndex')->name('product.category.index');


Route::group(['prefix'=>'user','middleware'=>'auth'],function(){
   Route::get('/profile','User\ProfileController@index')->name('user.profile');
   Route::post('/profile/store','User\ProfileController@store')->name('user.profile.store');
   Route::get('/order','User\OrderController@index')->name('user.order.index');
   Route::get('/order/{id}','User\OrderController@detail')->name('user.order.detail');
   Route::get('/address','User\AddressController@index')->name('user.address.index');
   Route::get('/address/{type}','User\AddressController@detail')->name('user.address.detail');
   Route::post('/address/{type}/store','User\AddressController@store')->name('user.address.store');
   Route::get('/change-password/','User\PasswordController@index')->name('user.password');
   Route::post('/change-password/store','User\PasswordController@store')->name('user.password.store');
   Route::get('/notification','User\NotificationController@index')->name('user.notification');
});

Route::group(['prefix'=>'pos'],function(){
   Route::get('/','POSController@index')->name('pos');
});

Route::get('page/{slug}','PageController@detail')->name('page.detail');
