<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'store'],function(){
    Route::get('/{slug}','Vendor\StoreController@index')->name('store');
});
