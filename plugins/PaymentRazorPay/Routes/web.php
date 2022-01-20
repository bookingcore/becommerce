<?php
use Illuminate\Support\Facades\Route;
Route::get('gateway_callback/checkourRazorPayGT/{c}/{r}/{is_normal?}','RazorPayCheckoutController@handleCheckout')->name('checkoutRazorPayGateway');
Route::post('gateway_callback/processRazorPayGT/{c}/{r}/{is_normal?}','RazorPayCheckoutController@handleProcess')->name('processRazorPayGateway');
