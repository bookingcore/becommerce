<?php

use \Illuminate\Support\Facades\Route;

Route::get('/','VendorController@index')->name('vendor.admin.index');
Route::get('/create','VendorController@create')->name('vendor.admin.create');
Route::get('/edit/{id}','VendorController@edit')->name('vendor.admin.edit');
Route::post('/store/{id?}','VendorController@store')->name('vendor.admin.store');
Route::post('/bulkEdit','VendorController@bulkEdit')->name('vendor.admin.bulkEdit');
Route::get('/export','VendorController@export')->name('vendor.admin.export');
Route::get('/getForSelect2','VendorController@getForSelect2')->name('vendor.admin.getForSelect2');

Route::get('/register-request','RegisterRequestController@index')->name('vendor.admin.request');
Route::post('/register-request/bulkEdit','RegisterRequestController@bulkEdit')->name('vendor.admin.request.bulkEdit');
Route::post('/register-request/store/{id}','RegisterRequestController@store')->name('vendor.admin.request.store');

Route::group(['prefix'=>'payout'],function(){
    Route::get('/','PayoutController@index')->name('vendor.admin.payout.index');
    Route::post('/bulkEdit','PayoutController@bulkEdit')->name('vendor.admin.payout.bulkEdit');
});
