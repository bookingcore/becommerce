<?php
// Booking
//Route::get('/checkout','BookingController@checkout')->name('booking.checkout');
//
//Route::group(['prefix'=>env('BOOKING_ROUTE_PREFIX', 'booking')],function(){
//    Route::post('/addToCart','BookingController@addToCart')->name('booking.addToCart');
//    Route::post('/remove_cart_item','BookingController@removeCartItem')->name('booking.remove_cart_item');
//    Route::match(['get','post'],'/cart','BookingController@cart')->name('booking.cart');
//    Route::post('/doCheckout','BookingController@doCheckout');
//    Route::get('/confirm/{gateway}','BookingController@confirmPayment');
//    Route::get('/cancel/{gateway}','BookingController@cancelPayment');
//    Route::get('/{code}','BookingController@detail');
//    Route::get('/{code}/checkout','BookingController@checkout');
//    Route::get('/{code}/check-status','BookingController@checkStatusCheckout');
//});
//
//Route::get('order/{code}','BookingController@detail')->name('order.detail');
