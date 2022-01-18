<?php
use Illuminate\Support\Facades\Route;

Route::get('/overview','ReportController@overview')->name('report.overview');
Route::get('/products','ReportController@products')->name('report.products');
Route::get('/revenue','ReportController@revenue')->name('report.revenue');
Route::get('/orders','ReportController@orders')->name('report.orders');
