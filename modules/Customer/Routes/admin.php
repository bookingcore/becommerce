<?php
use \Illuminate\Support\Facades\Route;
Route::get('/','CustomerController@index')->name('customer.admin.index');
Route::get('/create','CustomerController@create')->name('customer.admin.create');
Route::get('/edit/{id}','CustomerController@edit')->name('customer.admin.edit');
Route::post('/store/{id?}','CustomerController@store')->name('customer.admin.store');
Route::post('/bulkEdit','CustomerController@bulkEdit')->name('customer.admin.bulkEdit');
Route::get('/export','CustomerController@export')->name('customer.admin.export');
Route::get('/getForSelect2','CustomerController@getForSelect2')->name('customer.admin.getForSelect2');