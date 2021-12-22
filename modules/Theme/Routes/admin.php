<?php
use \Illuminate\Support\Facades\Route;

Route::get('/', 'ThemeController@index')->name('theme.admin.index');
