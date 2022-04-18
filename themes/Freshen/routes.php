<?php
use \Illuminate\Support\Facades\Route;
Route::get('/product','ProductController@index')->name('product.index');
