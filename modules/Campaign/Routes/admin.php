<?php
use Illuminate\Support\Facades\Route;

Route::get('/','CampaignController@index')->name('campaign.admin.index');
Route::get('/create','CampaignController@create')->name('campaign.admin.create');
Route::get('/edit/{id}','CampaignController@edit')->name('campaign.admin.edit');
Route::post('/store/{id}','CampaignController@store')->name('campaign.admin.store');
Route::post('/bulkEdit','CampaignController@bulkEdit')->name('campaign.admin.bulkEdit');
Route::post('product/add/{campaign}','ProductController@add')->name('campaign.admin.product.add');
Route::post('product/bulkEdit/{campaign}','ProductController@bulkEdit')->name('campaign.admin.product.bulkEdit');
Route::get('product/search/{campaign}','ProductController@search')->name('campaign.admin.product.search');
