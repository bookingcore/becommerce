<?php
use \Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1/auth'
], function ($router) {
    Route::post('login', 'V1\AuthController@login')->name('user.api.login');
    Route::post('logout', 'V1\AuthController@logout')->name('user.api.logout');
    Route::put('password', 'V1\AuthController@changePassword')->name('user.api.changePassword');
});

Route::group([
    'prefix' => 'v1/user'
], function ($router) {
    Route::get('me', 'V1\CurrentUserController@me')->name('user.api.me');
    Route::patch('me', 'V1\CurrentUserController@patch')->name('user.api.patch');

    Route::get('me/address', 'V1\CurrentUserController@address')->name('user.api.address');
    Route::post('me/address', 'V1\CurrentUserController@updateAddress')->name('user.api.updateAddress');

    Route::get('me/wishlist', 'V1\CurrentUserController@wishlist')->name('user.api.wishlist');
    Route::post('me/wishlist', 'V1\CurrentUserController@wishlistStore')->name('user.api.wishlistStore');
    Route::delete('me/wishlist', 'V1\CurrentUserController@wishlistDelete')->name('user.api.wishlistDelete');
});
