<?php

use \Illuminate\Support\Facades\Route;


Route::get('/','ProductController@index')->name('product.admin.index');
Route::get('/create','ProductController@create')->name('product.admin.create');
Route::get('/edit/{id}','ProductController@edit')->name('product.admin.edit');
Route::post('/store/{id}','ProductController@store')->name('product.admin.store');
Route::post('/bulkEdit','ProductController@bulkEdit')->name('product.admin.bulkEdit');
Route::post('/bulkEdit','ProductController@bulkEdit')->name('product.admin.bulkEdit');

Route::group(['prefix'=>'attribute'],function (){
    Route::get('/','AttributeController@index')->name('product.admin.attribute.index');
    Route::get('edit/{id}','AttributeController@edit')->name('product.admin.attribute.edit');
    Route::post('store/{id}','AttributeController@store')->name('product.admin.attribute.store');

    Route::get('terms/{id}','AttributeController@terms')->name('product.admin.attribute.term.index');
    Route::get('term_edit/{id}','AttributeController@term_edit')->name('product.admin.attribute.term.edit');
    Route::get('term_store','AttributeController@term_store')->name('product.admin.attribute.term.store');

    Route::get('getForSelect2','AttributeController@getForSelect2')->name('product.admin.attribute.term.getForSelect2');
});
