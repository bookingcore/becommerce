<?php
use \Illuminate\Support\Facades\Route;
Route::get('term/getForSelect2','TermController@index')->name('core.admin.term.getForSelect2');
Route::group(['prefix'=>'updater'],function (){
    Route::get('/','UpdaterController@index')->name('core.admin.updater.index');
    Route::post('/store_license','UpdaterController@storeLicense')->name('core.admin.updater.store_license');
    Route::post('/check_update','UpdaterController@checkUpdate')->name('core.admin.updater.check_update');
    Route::post('/do_update','UpdaterController@doUpdate')->name('core.admin.updater.do_update');
});


Route::group(['prefix'=>'plugins'],function (){
    Route::get('/','PluginsController@index')->name('core.admin.plugins.index');
    Route::post('/','PluginsController@bulkEdit')->name('core.admin.plugins.bulkEdit');
});

Route::group(['prefix'=>'settings'],function (){
    Route::get('/index/{group}','SettingsController@index')->name('core.admin.setting.index');
    Route::post('/store/{group}','SettingsController@store')->name('core.admin.setting.store');
});


Route::group(['prefix'=>'menu'],function (){
    Route::get('/','MenuController@index')->name('core.admin.menu.index');
    Route::get('/create','MenuController@create')->name('core.admin.menu.create');
    Route::get('/edit/{id}', 'MenuController@edit')->name('core.admin.menu.edit');
    Route::post('/store','MenuController@store')->name('core.admin.menu.store');
    Route::post('/getTypes','MenuController@getTypes')->name('core.admin.menu.getTypes');
});
