<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/v1'],function(){
   Route::get('/product','V1\ProductController@index')->name('product.api.index');
   Route::get('/product/{id}','V1\ProductController@detail')->name('product.api.detail');
   Route::get('/product/{id}/review','V1\ReviewController@index')->name('product.api.review');
   Route::post('/product/{id}/review','V1\ReviewController@store')->name('product.api.review.store')->middleware('auth:sanctum');
   Route::get('/category','V1\CategoryController@index')->name('product.api.category');
});
