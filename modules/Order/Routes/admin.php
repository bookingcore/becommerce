<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/1/2019
 * Time: 10:02 AM
 */
use Illuminate\Support\Facades\Route;
Route::get('/','OrderController@index')->name('order.admin.index');
Route::post('post/bulkEdit','OrderController@bulkEdit')->name('order.admin.bulkEdit');
