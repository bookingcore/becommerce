<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/intro','LandingpageController@index');
Route::get('/', 'HomeController@index');
Route::post('/install/check-db', 'HomeController@checkConnectDatabase');

//Custom User Login and Register
Route::post('register','\Modules\User\Controllers\UserController@userRegister')->name('auth.register');
Route::post('login','\Modules\User\Controllers\UserController@userLogin')->name('auth.login');
Route::post('logout','\Modules\User\Controllers\UserController@logout')->name('auth.logout');
// Social Login
Route::get('social-login/{provider}', 'Auth\LoginController@socialLogin');
Route::get('social-callback/{provider}', 'Auth\LoginController@socialCallBack');

//Contact
Route::match(['get','post'],'/contact','\Modules\Contact\Controllers\ContactController@index'); // Contact
Route::match(['post'],'/contact/store','\Modules\Contact\Controllers\ContactController@store'); // Contact

Route::get('/test_functions', 'HomeController@test');
Route::get('/update', 'HomeController@updateMigrate');

//Homepage
Route::post('newsletter/subscribe','\Modules\User\Controllers\UserController@subscribe')->name('newsletter.subscribe');

// Media
Route::group(['prefix'=>'media'],function(){
    Route::get('/preview/{id}/{size?}','\Modules\Media\Controllers\MediaController@preview');//
});
Route::group(['middleware' => ['auth']],function(){
    Route::match(['get','post'],'/admin/module/media/store','\Modules\Media\Admin\MediaController@store');
    Route::match(['get','post'],'/admin/module/media/getLists','\Modules\Media\Admin\MediaController@getLists');
});

//Review
Route::group(['middleware' => ['auth']],function(){
    Route::get('/review',function (){ return redirect('/'); });
    Route::post('/review','\Modules\Review\Controllers\ReviewController@addReview');
});

// Logs
Route::get('admin/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware(['auth', 'dashboard','system_log_view']);
