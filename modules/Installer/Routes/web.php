<?php
use Illuminate\Support\Facades\Route;
Route::group(['prefix'=>'installer'],function(){
    Route::get('/','InstallerController@index')->name('installer.index');
    Route::post('/save_db','InstallerController@save_db')->name('installer.save_db');
});
