<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'product'],function(){
    Route::get('/','ProductController@index')->name('product.index'); // Search
    Route::get('/{slug}','ProductController@detail')->name('product.detail');// Detail
    Route::post('/quick_view/{id}', 'ProductController@quick_view')->name('product.quickView');
});

Route::group(['prefix'=>'category'],function(){
    Route::get('/{slug}','ProductController@categoryIndex')->name('product.category.index'); // Search
});

Route::get('/store-list', 'ProductController@store_list')->name('product.vendor.store');
