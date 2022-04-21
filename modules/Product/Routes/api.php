<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/v1'],function(){
   Route::get('/product','V1\ProductController@index')->name('product.api.index');
   Route::get('/category','V1\CategoryController@index')->name('product.api.category');
});
