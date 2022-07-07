<?php
use Illuminate\Support\Facades\Route;
Route::get('customer/getForSelect2','CustomerController@getForSelect2')->name('customer.getForSelect2')->middleware(['auth']);
