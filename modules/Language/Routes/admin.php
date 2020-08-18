<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/1/2019
 * Time: 10:02 AM
 */
use Illuminate\Support\Facades\Route;
Route::match(['get','post'],'/','LanguageController@index')->name('language.admin.index');
Route::match(['get','post'],'/edit/{id}','LanguageController@edit')->name('language.admin.edit');
Route::post('/editBulk','LanguageController@editBulk')->name('language.admin.editBulk');

Route::match(['get'],'/translations','TranslationsController@index')->name('language.admin.translations.index');
Route::match(['get'],'/translations/detail/{id}','TranslationsController@detail')->name('language.admin.translations.detail');
Route::match(['post'],'/translations/store/{id}','TranslationsController@store')->name('language.admin.translations.store');
Route::match(['get'],'/translations/build/{id}','TranslationsController@build')->name('language.admin.translations.build');
Route::match(['get'],'/translations/loadStrings','TranslationsController@loadStrings')->name('language.admin.translations.loadStrings');
Route::match(['get'],'/translations/genDefault','TranslationsController@genDefault')->name('language.admin.translations.genDefault');
Route::match(['get'],'/translations/findTranslations','TranslationsController@findTranslations')->name('language.admin.translations.findTranslations');
