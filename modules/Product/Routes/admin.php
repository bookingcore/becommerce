<?php

use \Illuminate\Support\Facades\Route;


Route::get('/','ProductController@index')->name('product.admin.index');
Route::get('/create','ProductController@create')->name('product.admin.create');
Route::get('/edit/{id}','ProductController@edit')->name('product.admin.edit');
Route::post('/store/{id}','ProductController@store')->name('product.admin.store');
Route::post('/bulkEdit','ProductController@bulkEdit')->name('product.admin.bulkEdit');
Route::get('/ajaxVariationList/{id}','VariationController@ajaxVariationList')->name('product.admin.ajaxVariationList');
Route::post('/ajaxAddVariation','VariationController@ajaxAddVariation')->name('product.admin.variation.ajaxAddVariation');
Route::post('/ajaxDeleteVariation','VariationController@ajaxDeleteVariation')->name('product.admin.variation.ajaxDeleteVariation');
Route::post('/ajaxSaveVariations','VariationController@ajaxSaveVariations')->name('product.admin.variation.ajaxSaveVariations');

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
    Route::get('/shipping-zone/create', 'ShippingSettingContainer@zoneCreate')->name('product.shipping.create');
    Route::get('/shipping-zone/edit/{id}', 'ShippingSettingContainer@zoneEdit')->name('product.shipping.edit');
    Route::post('/shipping-zone/store', 'ShippingSettingContainer@zoneStore')->name('product.shipping.store');
    Route::get('/shipping-zone/delete/{id}', 'ShippingSettingContainer@zoneDelete')->name('product.shipping.delete');

    Route::get('/shipping-zone/{zone_id}/shipping-method/create', 'ShippingSettingContainer@methodCreate')->name('product.shipping.method.create');
    Route::get('/shipping-zone/{zone_id}/shipping-method/edit/{id}', 'ShippingSettingContainer@methodEdit')->name('product.shipping.method.edit');
    Route::post('/shipping-zone/shipping-method/store', 'ShippingSettingContainer@methodStore')->name('product.shipping.method.store');
    Route::get('/shipping-zone/shipping-method/delete/{id}', 'ShippingSettingContainer@methodDelete')->name('product.shipping.method.delete');

    Route::get('/shipping-class/create', 'ShippingSettingContainer@shippingClassCreate')->name('product.shipping.class.create');
    Route::get('/shipping-class/edit/{id}', 'ShippingSettingContainer@shippingClassEdit')->name('product.shipping.class.edit');
    Route::post('/shipping-class/store', 'ShippingSettingContainer@shippingClassStore')->name('product.shipping.class.store');
    Route::get('/shipping-class/delete/{id}', 'ShippingSettingContainer@shippingClassDelete')->name('product.shipping.class.delete');

    Route::get('/tax/create', 'TaxSettingContainer@create')->name('product.tax.create');
    Route::get('/tax/edit/{id}', 'TaxSettingContainer@edit')->name('product.tax.edit');
    Route::post('/tax/store', 'TaxSettingContainer@store')->name('product.tax.store');
    Route::get('/tax/delete/{id}', 'TaxSettingContainer@delete')->name('product.tax.delete');

});
