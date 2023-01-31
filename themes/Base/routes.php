<?php
use \Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('home');
Route::post('/contact/store','ContactController@store')->name("contact.store");
Route::get('/product','ProductController@index')->name('product.index');
Route::get('/quick_view/{id}','ProductController@quick_view')->name('product.quick_view');
Route::get('/product/{slug}','ProductController@detail')->name('product.detail');
Route::get('/category/{slug}','ProductController@categoryIndex')->name('product.category.index');

Route::post('/product/compare','ProductController@compare')->name('product.compare');
Route::post('/product/remove_compare','ProductController@remove_compare')->name('product.remove.compare');

Route::group(['prefix'=>'news'],function(){
    Route::get('/','NewsController@index')->name('news');
    Route::get('/{slug}','NewsController@detail')->name('news.detail');
    Route::get('/category/{slug}','NewsController@category')->name('news.category');
    Route::get('/tag/{slug}','NewsController@tag')->name('news.tag');
});

Route::name('location.')->prefix('location')->group(function(){
    Route::get('set/{location}','LocationController@set')->name('set');
});

Route::group(['prefix'=>'user','middleware'=>['auth','verified']],function(){
   Route::get('/profile','User\ProfileController@index')->name('user.profile');
   Route::post('/profile/store','User\ProfileController@store')->name('user.profile.store');
   Route::get('/order','User\OrderController@index')->name('user.order.index');
   Route::get('/order/{id}','User\OrderController@detail')->name('user.order.detail');
   Route::get('/address','User\AddressController@index')->name('user.address.index');
   Route::get('/address/{type}','User\AddressController@detail')->name('user.address.detail');
   Route::post('/address/{type}/store','User\AddressController@store')->name('user.address.store');
   Route::get('/change-password/','User\PasswordController@index')->name('user.password');
   Route::post('/change-password/store','User\PasswordController@store')->name('user.password.store');
   Route::get('/notification','User\NotificationController@index')->name('user.notification');

    Route::get('/wishlist','User\UserWishListController@index')->name("user.wishList.index");
    Route::post('/wishlist','User\UserWishListController@handleWishList')->name("user.wishList.handle");
    Route::get('/wishlist/remove','User\UserWishListController@remove')->name("user.wishList.remove");

    Route::group(['prefix'=>'download'],function(){
        Route::get('/','User\DownloadController@index')->name("user.download.index");
        Route::get('/start-download/{id}/{file_id}','User\DownloadController@download')->name("user.download.start")->middleware('signed');
    });

});

Route::group(['prefix'=>'vendor'],function(){
   Route::get('/register','Vendor\RegisterController@index')->name('vendor.register');
   Route::post('/register/store','Vendor\RegisterController@store')->name('vendor.register.store');
});

Route::group(['prefix'=>'vendor','middleware'=>['auth','verified']],function(){
   Route::get('/dashboard','Vendor\DashboardController@index')->name('vendor.dashboard');

   Route::group(['prefix'=>'product'],function(){
       Route::get('/','Vendor\ProductController@index')->name('vendor.product');
       Route::get('/create','Vendor\ProductController@create')->name('vendor.product.create');
       Route::get('/edit/{id}','Vendor\ProductController@edit')->name('vendor.product.edit');
       Route::post('/store/{id?}','Vendor\ProductController@store')->name('vendor.product.store');
       Route::get('/delete/{id?}','Vendor\ProductController@delete')->name('vendor.product.delete');

       Route::get('/search','Vendor\ProductController@search')->name('vendor.product.search');
       Route::get('/sell/{product}','Vendor\ProductController@sell')->name('vendor.product.sell');
       Route::post('/sell/{product}/store','Vendor\ProductController@sellStore')->name('vendor.product.sell.store');
   });

   Route::get('/order','Vendor\OrderController@index')->name('vendor.order');
   Route::post('/order/bulkEdit','Vendor\OrderController@bulkEdit')->name('vendor.order.bulkEdit');

   Route::get('/payout','Vendor\PayoutController@index')->name('vendor.payout');
   Route::post('/payout/account/store','Vendor\PayoutController@storePayoutAccount')->name('vendor.payout.account.store');

   Route::get('/review','Vendor\ReviewController@index')->name('vendor.review');
   Route::get('/profile','Vendor\StoreController@profile')->name('vendor.profile');
   Route::post('/profile/store','Vendor\StoreController@profileStore')->name('vendor.profile.store');
});

Route::group(['prefix'=>'store'],function(){
   Route::get('/{slug}','Vendor\StoreController@index')->name('store');
    Route::get('/{slug}/reviews','Vendor\StoreController@allReviews')->name("store.reviews");
});

//Review
Route::group(['middleware' => ['auth','verified']],function(){
    Route::post('/review','ReviewController@store')->name('review.store');
});


Route::get('page/{slug}','PageController@detail')->name('page.detail');

Route::group(['prefix'=>config('order.cart_route_prefix')],function(){
    Route::get('/','Order\CartController@index')->name('cart');
    Route::post('/addToCart','Order\CartController@addToCart')->name('cart.addToCart');
    Route::post('/remove_cart_item','Order\CartController@removeCartItem')->name('cart.remove_cart_item');
    Route::post('/update','Order\CartController@updateCartItem')->name('cart.update_cart_item');

    // Coupon
    Route::post('/apply_coupon','Order\CouponController@applyCoupon')->name('cart.coupon.apply');
    Route::post('/remove_coupon','Order\CouponController@removeCoupon')->name('cart.coupon.remove');
    //Shipping
    Route::post('/get_shipping_method','Order\CartController@getShippingMethod')->name('cart.shipping.get_method');
    //Tax
    Route::post('/get_tax_rate','Order\CartController@getTaxRate')->name('cart.shipping.get_method');
});
Route::group(['prefix'=>'checkout'],function(){
    Route::get('/','Order\CheckoutController@toCheckout')->name('checkout');
    Route::get('/{code}','Order\CheckoutController@index')->name('checkout.detail');
    Route::post('/{code}/process','Order\CheckoutController@process')->name('checkout.process');
});

Route::group(['prefix'=>config('order.order_route_prefix')],function(){
    Route::get('/confirm/{gateway}','Order\OrderController@confirmPayment')->name('order.confirm');
    Route::get('/cancel/{gateway}','Order\OrderController@cancelPayment')->name('order.cancel');
    Route::match(['get','post'],'/callback/{gateway}','Order\OrderController@callbackPayment')->name('order.callback');
    Route::get('/{code}','Order\OrderController@detail')->name('order.detail');
    Route::get('/modal/{code}','Order\OrderController@modal')->name('order.modal')->middleware('auth');
    Route::match(['get','post'],'/gateway_callback/{gateway}','Order\OrderController@callbackPayment')->name('order.gateway.webhook');
});


Route::get('register','User\RegisterController@index')->name('register');
Route::post('register','User\RegisterController@store')->name('register.store');

//Newsletter
Route::post('newsletter/subscribe','UserController@subscribe')->name('newsletter.subscribe');

Route::group(['prefix'=>'pos','middleware'=>['auth','verified']],function(){
    Route::get('/','POSController@index')->name('pos');
});


// Social Login
Route::get('social-login/{provider}', 'User\SocialLoginController@login');
Route::get('social-callback/{provider}', 'User\SocialLoginController@callBack');
