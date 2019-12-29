<?php

use \Illuminate\Support\Facades\Route;


Route::get('/','TemplateController@index')->name('template.admin.index');
Route::get('/create','TemplateController@create')->name('template.admin.create');
Route::get('/edit/{id}','TemplateController@edit')->name('template.admin.edit');
Route::get('/getBlocks','TemplateController@getBlocks')->name('template.admin.getBlocks');
Route::post('/store','TemplateController@store')->name('template.admin.store');
Route::post('/bulkEdit','TemplateController@bulkEdit')->name('template.admin.bulkEdit');
