<?php
use Illuminate\Support\Facades\Route;

Route::get('gateway_callback/checkoutFlutterWaveGateway/{order_id}','FlutterWaveCheckoutController@handleCheckout')->name('checkoutFlutterWaveGateway');



