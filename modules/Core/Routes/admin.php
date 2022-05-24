<?php
use \Illuminate\Support\Facades\Route;

Route::get('term/getForSelect2','TermController@index')->name('core.admin.term.getForSelect2');
Route::post('markAsRead','NotificationController@markAsRead')->name('core.admin.notification.markAsRead');
Route::post('markAllAsRead','NotificationController@markAllAsRead')->name('core.admin.notification.markAllAsRead');
Route::get('notifications','NotificationController@loadNotify')->name('core.admin.notification.loadNotify');


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

Route::get('settings/index', 'SettingsController@index')->name('core.admin.setting.index');
Route::get('settings/{group}', 'SettingsController@group')->name('core.admin.setting');
Route::post('settings/store/{group}', 'SettingsController@store')->name('core.admin.setting.store');

Route::get('setting-zone/{zone_id}', 'SettingsController@zone')->name('core.admin.setting.zone');

Route::get('tools', 'ToolsController@index')->name('core.admin.tool');
Route::match(['get','post'],'schedule', 'ToolsController@schedule')->name('core.admin.tool.schedule');

Route::group(['prefix' => 'menu'], function () {
    Route::get('/', 'MenuController@index')->name('core.admin.menu.index');
    Route::get('/create', 'MenuController@create')->name('core.admin.menu.create');
    Route::get('/edit/{id}', 'MenuController@edit')->name('core.admin.menu.edit');
    Route::post('/store', 'MenuController@store')->name('core.admin.menu.store');
    Route::post('/getTypes', 'MenuController@getTypes')->name('core.admin.menu.getTypes');

    Route::post('/bulkEdit','MenuController@bulkEdit')->name('core.admin.menu.bulkEdit');
});

Route::get('mobile/to-builder','MobileController@toBuilder')->name('core.admin.mobile.toBuilder');

Route::get('search/sync/{driver}','SearchEngineController@sync')->name('core.admin.search.sync')->middleware('signed');
