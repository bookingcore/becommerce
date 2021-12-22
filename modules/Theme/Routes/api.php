<?php
use \Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group(["prefix"=>'user'],function(){
    Route::post("/","UserController@index");
    Route::group(["prefix"=>'{id}'],function(){
        Route::get("/","UserController@detail");
        Route::post("/","UserController@store");
        Route::patch("/","UserController@patch");
        Route::delete("/","UserController@delete");
    });
});
