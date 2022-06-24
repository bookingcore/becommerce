<?php

use \Illuminate\Support\Facades\Route;


Route::get('/','ReviewController@index')->name('review.admin.index');
Route::post('/bulkEdit','ReviewController@bulkEdit')->name('review.admin.bulkEdit');

