<?php
use Illuminate\Support\Facades\Route;

Route::get('/overview','ReportController@overview')->name('report.admin.overview');
Route::get('/products','ReportController@products')->name('report.admin.products');
Route::get('/products/export', 'ReportController@productExport')->name('report.admin.products.export');

Route::get('/revenue','ReportController@revenue')->name('report.admin.revenue');
Route::get('/revenue/export', 'ReportController@revenueExport')->name('report.admin.revenue.export');

//Route::get('/orders','ReportController@orders')->name('report.admin.orders');
