<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'v1/'],function(){
    Route::get('/product/filter','V1\ProductController@filter')->name('product.api.filter');
});
