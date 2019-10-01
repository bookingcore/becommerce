<?php

use \Illuminate\Support\Facades\Route;


Route::get('/','ProductController@index')->name('product.admin.index');
Route::get('/create','ProductController@create')->name('product.admin.create');
Route::get('/edit/{id}','ProductController@edit')->name('product.admin.edit');
Route::post('/store/{id}','ProductController@store')->name('product.admin.store');
Route::post('/bulkEdit','ProductController@bulkEdit')->name('product.admin.bulkEdit');
Route::post('/bulkEdit','ProductController@bulkEdit')->name('product.admin.bulkEdit');

Route::group(['prefix'=>'category'],function (){
    Route::get('/','CategoryController@index')->name('product.admin.category.index');
    Route::get('edit/{id}','CategoryController@edit')->name('product.admin.category.edit');
    Route::post('store/{id}','CategoryController@store')->name('product.admin.category.store');
    Route::post('editBulk','CategoryController@editBulk')->name('product.admin.category.editBulk');
});
Route::group(['prefix'=>'brand'],function (){
	Route::get('/','BrandController@index')->name('product.admin.brand.index');
	Route::get('edit/{id}','BrandController@edit')->name('product.admin.brand.edit');
	Route::post('store/{id}','BrandController@store')->name('product.admin.brand.store');
	Route::post('editBulk','BrandController@editBulk')->name('product.admin.brand.editBulk');
	Route::get('getForSelect2','BrandController@getForSelect2')->name('product.admin.brand.getForSelect2');

});

Route::group(['prefix'=>'tag'],function (){
    Route::get('/','TagController@index')->name('product.admin.tag.index');
    Route::get('edit/{id}','TagController@edit')->name('product.admin.tag.edit');
    Route::post('store/{id}','TagController@store')->name('product.admin.tag.store');
});

Route::group(['prefix'=>'attribute'],function (){
    Route::get('/','AttributeController@index')->name('product.admin.attribute.index');
    Route::get('edit/{id}','AttributeController@edit')->name('product.admin.attribute.edit');
    Route::post('store/{id}','AttributeController@store')->name('product.admin.attribute.store');

    Route::get('terms/{id}','AttributeController@terms')->name('product.admin.attribute.term.index');
    Route::get('term_edit/{id}','AttributeController@term_edit')->name('product.admin.attribute.term.edit');
    Route::post('term_store','AttributeController@term_store')->name('product.admin.attribute.term.store');

    Route::get('getForSelect2','AttributeController@getForSelect2')->name('product.admin.attribute.term.getForSelect2');

    Route::group(['prefix'=>'variations/{id}'],function (){
        Route::get('/','VariationController@index')->name('product.admin.variation.index');
        Route::post('/store_attrs','VariationController@storeAttrs')->name('product.admin.variation.store_attrs');
        Route::post('/store','VariationController@store')->name('product.admin.variation.store');
    });
});

