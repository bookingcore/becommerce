<?php

use \Illuminate\Support\Facades\Route;


Route::get('/','ReviewController@index')->name('product.admin.review.index');
Route::post('/','ReviewController@index')->name('product.admin.review.index');
Route::post('/bulkEdit','ReviewController@bulkEdit')->name('product.admin.review.bulkEdit');

