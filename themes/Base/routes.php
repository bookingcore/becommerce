<?php
use \Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('home');
Route::get('/product','ProductController@index')->name('product.index');
Route::get('/category/{slug}','ProductController@categoryIndex')->name('product.category.index');


Route::group(['prefix'=>'news'],function(){
    Route::get('/','NewsController@index')->name('news');
    Route::get('/{slug}','NewsController@detail')->name('news.detail');
    Route::get('/category/{slug}','NewsController@category')->name('news.category');
    Route::get('/tag/{slug}','NewsController@tag')->name('news.tag');
});

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

Route::group(['prefix'=>'vendor','middleware'=>'auth'],function(){
   Route::get('/dashboard','Vendor\DashboardController@index')->name('vendor.dashboard');
   Route::get('/product','Vendor\ProductController@index')->name('vendor.product');
   Route::get('/product/create','Vendor\ProductController@create')->name('vendor.product.create');
   Route::get('/product/edit/{id}','Vendor\ProductController@edit')->name('vendor.product.edit');
   Route::post('/product/store/{id?}','Vendor\ProductController@store')->name('vendor.product.store');
});
Route::group(['prefix'=>'store','middleware'=>'auth'],function(){
   Route::get('/{slug}','Vendor\StoreController@index')->name('store');
});

Route::group(['prefix'=>'pos'],function(){
   Route::get('/','POSController@index')->name('pos');
});

Route::get('page/{slug}','PageController@detail')->name('page.detail');

Route::group(['prefix'=>'cart','middleware'=>'auth'],function(){
    Route::get('/','Order\CartController@index')->name('cart');
    Route::post('/addToCart','Order\CartController@addToCart')->name('cart.addToCart');
    Route::post('/remove_cart_item','Order\CartController@removeCartItem')->name('cart.remove_cart_item');
    Route::post('/update','Order\CartController@updateCartItem')->name('cart.update_cart_item');

});
Route::group(['prefix'=>'checkout','middleware'=>'auth'],function(){
    Route::get('/','Order\CheckoutController@index')->name('checkout');
    Route::post('/process','Order\CheckoutController@process')->name('checkout.process');
});
Route::group(['prefix'=>'order'],function(){
    Route::get('/confirm/{gateway}','Order\OrderController@confirmPayment')->name('order.confirm');
    Route::get('/cancel/{gateway}','Order\OrderController@cancelPayment')->name('order.cancel');
    Route::get('/{id}','Order\OrderController@detail')->name('order.detail')->middleware('auth');
});
