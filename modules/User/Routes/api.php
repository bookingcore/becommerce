<?php
use \Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1/auth'
], function ($router) {
    Route::post('login', 'V1\AuthController@login');
    Route::post('logout', 'V1\AuthController@logout');
    Route::put('password', 'V1\AuthController@changePassword');
});

Route::group([
    'prefix' => 'v1/user'
], function ($router) {
    Route::get('me', 'V1\CurrentUserController@me')->name('user.api.me');
    Route::get('me/address', 'V1\CurrentUserController@address')->name('user.api.address');
    Route::get('me/wishlist', 'V1\CurrentUserController@wishlist')->name('user.api.wishlist');
    Route::post('me/wishlist', 'V1\CurrentUserController@wishlistStore')->name('user.api.wishlistStore');
});
