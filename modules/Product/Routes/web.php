<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'product'],function(){
    Route::get('/','ProductController@index')->name('product.index'); // Search
    Route::get('/{slug}','ProductController@detail')->name('product.detail');// Detail
    Route::post('/quick_view/{id}', 'ProductController@quick_view')->name('product.quickView');
    Route::post('/compare','ProductController@compare')->name('product.compare');
    Route::post('/remove_compare','ProductController@remove_compare')->name('product.remove.compare');
});

Route::group(['prefix'=>'category'],function(){
    Route::get('/{slug}','ProductController@categoryIndex')->name('product.category.index'); // Search
});

Route::get('/your-recent-viewed','ProductController@recent_viewed')->name('product.recent.viewed');
Route::get('/store-list', 'ProductController@store_list')->name('product.vendor.store');

Route::group(['prefix'=>'vendor/product','middleware' => ['auth','verified']],function(){
    Route::match(['get','post'],'/','VendorController@manage')->name('product.vendor.index');
    Route::match(['get','post'],'/create','VendorController@create')->name('product.vendor.create');
    Route::match(['get','post'],'/edit/{slug}','VendorController@edit')->name('product.vendor.edit');
    Route::match(['get','post'],'/del/{slug}','VendorController@delete')->name('product.vendor.delete');
    Route::match(['post'],'/store/{slug}','VendorController@store')->name('product.vendor.store');
    Route::get('bulkEdit/{id}','VendorController@bulkEdit')->name("product.vendor.bulk_edit");
    Route::get('/orders','VendorController@orders')->name("product.vendor.orders");
    Route::get('/order/{id}','VendorController@orderDetail')->name("product.vendor.order_detail");
});

