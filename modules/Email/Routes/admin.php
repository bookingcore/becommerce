<?php
    use Illuminate\Support\Facades\Route;

    Route::post('/testEmail','EmailController@testEmail')->name('email.admin.testEmail');
