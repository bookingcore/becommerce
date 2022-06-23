<?php
use \Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'plugins'],function (){
    Route::get('/','PluginsController@index')->name('plugin.admin.index');
    Route::post('bulkEdit/','PluginsController@bulkEdit')->name('plugin.admin.bulkEdit');
    Route::post('active/{plugin}','PluginsController@active')->name('plugin.admin.active');
});
