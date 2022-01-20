<?php
use Illuminate\Support\Facades\Route;

Route::get('gateway_callback/checkoutFlutterWaveGateway/{order_id}','FlutterWaveCheckoutController@handleCheckout')->name('checkoutFlutterWaveGateway');
Route::get('gateway_callback/checkoutNormalFlutterWaveGateway/{order_id}','FlutterWaveCheckoutController@handleCheckoutNormal')->name('checkoutNormalFlutterWaveGateway');



