<?php
use \Illuminate\Support\Facades\Route;
Route::get('cart','CartController@index')->name('cart.index');
