<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'product'],function(){
    Route::get('/','ProductController@index')->name('product.index'); // Search
    Route::get('/{slug}','ProductController@detail')->name('product.detail');// Detail
});

Route::group(['prefix'=>'category'],function(){
    Route::get('/{slug}','ProductController@categoryIndex')->name('product.category.index'); // Search
});

//Route::group(['prefix'=>'user/product'],function(){
//    Route::match(['get','post'],'/','ManageSpaceController@manageSpace')->name('product.vendor.list');
//    Route::match(['get','post'],'/create','ManageSpaceController@createSpace')->name('product.vendor.create');
//    Route::match(['get','post'],'/edit/{slug}','ManageSpaceController@editSpace')->name('product.vendor.edit');
//    Route::match(['get','post'],'/del/{slug}','ManageSpaceController@deleteSpace')->name('product.vendor.delete');
//    Route::match(['post'],'/store/{slug}','ManageSpaceController@store')->name('product.vendor.store');
//    Route::get('/booking-report','ManageSpaceController@bookingReport')->name("product.vendor.booking_report");
//
//    Route::group(['prefix'=>'availability'],function(){
//        Route::get('/','AvailabilityController@index')->name('product.vendor.availability.index');
//        Route::get('/loadDates','AvailabilityController@loadDates')->name('product.vendor.availability.loadDates');
//        Route::match(['get','post'],'/store','AvailabilityController@store')->name('product.vendor.availability.store');
//    });
//});
