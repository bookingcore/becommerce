<?php
use \Illuminate\Support\Facades\Route;
Route::get('/product','ProductController@index')->name('product.index');
Route::get('/category/{slug}','ProductController@categoryIndex')->name('product.category.index');
