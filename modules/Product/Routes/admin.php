<?php

use \Illuminate\Support\Facades\Route;


Route::get('/','ProductController@index')->name('product.admin.index');
Route::get('/create','ProductController@create')->name('product.admin.create');
Route::get('/edit/{id}','ProductController@edit')->name('product.admin.edit');
Route::get('/getForSelect2','ProductController@getForSelect2')->name('product.admin.getForSelect2');
Route::post('/store/{id}','ProductController@store')->name('product.admin.store');
Route::post('/bulkEdit','ProductController@bulkEdit')->name('product.admin.bulkEdit');
Route::get('/ajaxVariationList/{id}','VariationController@ajaxVariationList')->name('product.admin.ajaxVariationList');
Route::post('/ajaxAddVariation','VariationController@ajaxAddVariation')->name('product.admin.variation.ajaxAddVariation');
Route::post('/ajaxDeleteVariation','VariationController@ajaxDeleteVariation')->name('product.admin.variation.ajaxDeleteVariation');
Route::post('/ajaxSaveVariations','VariationController@ajaxSaveVariations')->name('product.admin.variation.ajaxSaveVariations');
Route::post('/ajaxSaveTerms','ProductController@ajaxSaveTerms')->name('product.admin.ajaxSaveTerms');

Route::group(['prefix'=>'category'],function (){
    Route::get('/','CategoryController@index')->name('product.admin.category.index');
    Route::get('edit/{id}','CategoryController@edit')->name('product.admin.category.edit');
    Route::post('store/{id}','CategoryController@store')->name('product.admin.category.store');
    Route::post('editBulk','CategoryController@editBulk')->name('product.admin.category.editBulk');
});
Route::group(['prefix'=>'brand'],function (){
	Route::get('/','BrandController@index')->name('product.admin.brand.index');
	Route::get('edit/{id}','BrandController@edit')->name('product.admin.brand.edit');
	Route::post('store/{id}','BrandController@store')->name('product.admin.brand.store');
	Route::post('editBulk','BrandController@editBulk')->name('product.admin.brand.editBulk');
	Route::get('getForSelect2','BrandController@getForSelect2')->name('product.admin.brand.getForSelect2');

});

Route::group(['prefix'=>'tag'],function (){
    Route::get('/','TagController@index')->name('product.admin.tag.index');
    Route::get('edit/{id}','TagController@edit')->name('product.admin.tag.edit');
    Route::post('store/{id}','TagController@store')->name('product.admin.tag.store');
});

Route::group(['prefix'=>'attribute'],function (){
    Route::get('/','AttributeController@index')->name('product.admin.attribute.index');
    Route::post('/editAttrBulk','AttributeController@editAttrBulk')->name('product.admin.attribute.editattrbulk');
    Route::get('edit/{id}','AttributeController@edit')->name('product.admin.attribute.edit');
    Route::post('store/{id}','AttributeController@store')->name('product.admin.attribute.store');

    Route::get('terms/{id}','AttributeController@terms')->name('product.admin.attribute.term.index');
    Route::get('term_edit/{id}','AttributeController@term_edit')->name('product.admin.attribute.term.edit');
    Route::post('term_store','AttributeController@term_store')->name('product.admin.attribute.term.store');
    Route::post('/editTermBulk','AttributeController@editTermBulk')->name('product.admin.attribute.term.editTermBulk');

    Route::get('getForSelect2','AttributeController@getForSelect2')->name('product.admin.attribute.term.getForSelect2');

    Route::group(['prefix'=>'variations/{id}'],function (){
        Route::get('/','VariationController@index')->name('product.admin.variation.index');
        Route::post('/store_attrs','VariationController@storeAttrs')->name('product.admin.variation.store_attrs');
        Route::post('/store','VariationController@store')->name('product.admin.variation.store');
    });
});

Route::post('/ajaxAddTerm','AttributeController@ajaxAddTerm')->name('product.admin.attribute.ajaxAddTerm');


Route::group(['prefix'=>'category'],function (){
    Route::get('getForSelect2','CategoryController@getForSelect2')->name('product.admin.category.getForSelect2');
});

Route::group(['prefix'=>'coupon'],function (){
    Route::get('/','CouponController@index')->name('product.coupon.index');
    Route::get('/create','CouponController@create')->name('product.coupon.create');
    Route::get('/edit/{id}','CouponController@edit')->name('product.coupon.edit');
    Route::post('/store/{id}','CouponController@store')->name('product.coupon.store');
    Route::post('/bulkEdit','CouponController@bulkEdit')->name('product.coupon.bulkEdit');
});

Route::group(['prefix' => 'settings/shipping'], function (){
    Route::get('/zone/create', 'ShippingController@zoneCreate')->name('product.shipping.create');
    Route::get('/zone/edit/{id}', 'ShippingController@zoneEdit')->name('product.shipping.edit');
    Route::post('/zone/store', 'ShippingController@zoneStore')->name('product.shipping.store');
    Route::get('/zone/delete/{id}', 'ShippingController@zoneDelete')->name('product.shipping.delete');

    Route::get('/zone/{zone_id}/method/create', 'ShippingController@methodCreate')->name('product.shipping.method.create');
    Route::get('/zone/{zone_id}/method/edit/{id}', 'ShippingController@methodEdit')->name('product.shipping.method.edit');
    Route::post('/zone/method/store', 'ShippingController@methodStore')->name('product.shipping.method.store');
    Route::get('/zone/method/delete/{id}', 'ShippingController@methodDelete')->name('product.shipping.method.delete');

    Route::get('/shipping-class/create', 'ShippingController@shippingClassCreate')->name('product.shipping.class.create');
    Route::get('/shipping-class/edit/{id}', 'ShippingController@shippingClassEdit')->name('product.shipping.class.edit');
    Route::post('/shipping-class/store', 'ShippingController@shippingClassStore')->name('product.shipping.class.store');
    Route::get('/shipping-class/delete/{id}', 'ShippingController@shippingClassDelete')->name('product.shipping.class.delete');

});

Route::group(['prefix' => 'settings'], function (){
    Route::get('/tax/create', 'TaxController@create')->name('product.tax.create');
    Route::get('/tax/edit/{id}', 'TaxController@edit')->name('product.tax.edit');
    Route::post('/tax/store', 'TaxController@store')->name('product.tax.store');
    Route::get('/tax/delete/{id}', 'TaxController@delete')->name('product.tax.delete');
});
