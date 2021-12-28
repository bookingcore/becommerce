<?php
use \Illuminate\Support\Facades\Route;
Route::group(['prefix'=>'user','middleware' => ['auth','verified']],function(){
    Route::match(['get'],'/dashboard','UserController@dashboard')->name("vendor.dashboard");
    Route::post('/reloadChart','UserController@reloadChart');


    Route::post('/wishlist','UserWishListController@handleWishList')->name("user.wishList.handle");
    Route::get('/wishlist/remove','UserWishListController@remove')->name("user.wishList.remove");

    Route::group(['prefix'=>'verification'],function(){
        Route::match(['get'],'/','VerificationController@index')->name("user.verification.index");
        Route::match(['get'],'/update','VerificationController@update')->name("user.verification.update");
        Route::post('/store','VerificationController@store')->name("user.verification.store");
        Route::post('/send-code-verify-phone','VerificationController@sendCodeVerifyPhone')->name("user.verification.phone.sendCode");
        Route::post('/verify-phone','VerificationController@verifyPhone')->name("user.verification.phone.field");
    });
    Route::match(['get'],'/upgrade-vendor','UserController@upgradeVendor')->name("user.upgrade_vendor");
    Route::get('chat','ChatController@index')->name('user.chat');
});

Route::group(['prefix'=>"messenger",'middleware'=>'auth'],function(){
    Route::get('/', 'ChatController@iframe')->name(config('chatify.path'));
    Route::post('search','ChatController@search')->name('search');
    Route::post('getContacts', 'ChatController@getContacts')->name('contacts.get');
    Route::post('idInfo', 'ChatController@idFetchData');
});
//Newsletter
Route::post('newsletter/subscribe','UserController@subscribe')->name('newsletter.subscribe');

Route::get('/my-plan','PlanController@myPlan')->name('user.plan')->middleware('auth');
Route::get('/plan','PlanController@index')->name('plan');
Route::get('/plan/buy/{id}','PlanController@buy')->name('user.plan.buy')->middleware('auth');
