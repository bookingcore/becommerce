<?php
\Illuminate\Support\Facades\Route::group(['prefix'=>'product'],function(){
   \Illuminate\Support\Facades\Route::get('/','ProductController@index');
});
