<?php
use \Illuminate\Support\Facades\Route;

Route::post('pos/order/store','OrderController@store')->name('pos.order.store')->middleware('auth');
