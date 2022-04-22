<?php
use \Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1/auth'
], function ($router) {
    Route::post('login', 'V1\AuthController@login');
    Route::post('logout', 'V1\AuthController@logout');
    Route::put('password', 'V1\AuthController@changePassword');
    Route::get('me', 'V1\AuthController@me');
});
