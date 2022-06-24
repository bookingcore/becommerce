<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'event'],function(){
    Route::get('/','EventController@index')->name('event.index');
    Route::get('/{slug}','EventController@detail')->name('event.detail');
});
