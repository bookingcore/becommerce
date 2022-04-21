<?php
use Illuminate\Support\Facades\Route;
Route::group(['prefix'=>'v1'],function(){
   Route::get('/configs','V1\AppController@configs')->name('core.api.configs');
   Route::get('/layout','V1\AppController@layout')->name('core.api.layout');
});
