<?php
use \Illuminate\Support\Facades\Route;

Route::get('term/getForSelect2','TermController@index')->name('core.admin.term.getForSelect2');


Route::get('settings/index/{group}','SettingsController@index')->name('core.admin.settings.index');
Route::post('settings/store/{group}','SettingsController@store')->name('core.admin.settings.store');