<?php
use \Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('home');
Route::get('/product','ProductController@index')->name('product');
