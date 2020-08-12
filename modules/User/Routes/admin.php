<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/'],function (){
    Route::get('/','UserController@index')->name('user.admin.index');
    Route::get('/create','UserController@create')->name('user.admin.create');
    Route::get('/getForSelect2','UserController@getForSelect2')->name('user.admin.getForSelect2');
    Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
    Route::post('/bulkEdit', 'UserController@bulkEdit')->name('user.bulkEdit');
    Route::post('/store/{id}', 'UserController@store')->name('user.store');
    Route::get('/password/{id}', 'UserController@password')->name('user.password');
    Route::post('/changepass/{id}', 'UserController@changepass')->name('user.changepass');
    Route::get('/userUpgradeRequest','UserController@userUpgradeRequest')->name('user.userUpgradeRequest');
    Route::get('/userUpgradeRequestApproved','UserController@userUpgradeRequestApproved')->name('user.userUpgradeRequestApproved');
});

Route::group(['prefix'=>'/role'], function (){
    Route::get('/','RoleController@index')->name('user.role.index');
    Route::match(['get','post'],'/create','RoleController@create')->name('user.role.create');
    Route::match(['get','post'],'/edit/{id}','RoleController@edit')->name('user.role.edit');
    Route::get('/permission_matrix','RoleController@permission_matrix')->name('user.role.permission_matrix');
});

Route::group(['prefix'=>'subscriber'],function (){
    Route::get('/','SubscriberController@index')->name('user.subscriber.index');
    Route::post('/store','SubscriberController@store')->name('user.subscriber.store');
    Route::post('/editBulk','SubscriberController@editBulk')->name('user.subscriber.editBulk');
    Route::get('/export','SubscriberController@export')->name('user.subscriber.export');
});
