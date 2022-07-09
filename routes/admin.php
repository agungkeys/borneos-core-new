<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
  /*authentication*/
  Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('login', 'LoginController@submit')->name('login.submit');
    // Route::post('login', 'LoginController@submit')->middleware('actch');
    Route::get('logout', 'LoginController@logout')->name('logout');
  });

  /*authentication*/
  Route::group(['middleware' => ['auth:admin']], function () {
    //dashboard
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');

    // orders
    Route::get('/orders/{status}', 'OrderController@index')->name('orders');
    Route::get('/orders/detail/{order:prefix}', 'OrderController@detail')->name('orders.detail');
    Route::get('/orders/followUpMerchant/{order:prefix}', 'OrderController@FollowUpMerchant');
    Route::get('/orders', 'OrderController@all')->name('orders.all');
    Route::get('/order/add', 'OrderController@add')->name('orders.add');
    Route::post('/order/add', 'OrderController@store')->name('orders.store');
    Route::get('/orders/edit/{order:prefix}', 'OrderController@edit')->name('orders.edit');
    Route::put('/orders/update/{order:prefix}', 'OrderController@update')->name('orders.update');

    //categories
    Route::get('/master-category', 'CategoryController@master_category_index')->name('master-category');
    Route::get('/master-category/add', 'CategoryController@master_category_add')->name('master-category.add');
    Route::post('/master-category/add', 'CategoryController@master_category_store')->name('master-category.store');
    Route::get('/master-category/{id}', 'CategoryController@master_category_edit')->name('master-category.edit');
    Route::put('/master-category/{id}', 'CategoryController@master_category_update')->name('master-category.update');
    Route::delete('/master-category/{id}', 'CategoryController@master_category_delete')->name('master-category.delete');
    Route::get('/master-category/status/{id}/{status}', 'CategoryController@master_category_status')->name('master-category.status');

    //sub category
    Route::get('/master-sub-category', 'CategoryController@master_sub_category_index')->name('master-sub-category');
    Route::get('/master-sub-category/add', 'CategoryController@master_sub_category_add')->name('master-sub-category.add');
    Route::post('/master-sub-category/add', 'CategoryController@master_sub_category_store')->name('master-sub-category.store');
    Route::get('/master-sub-category/{id}', 'CategoryController@master_sub_category_edit')->name('master-sub-category.edit');
    Route::put('/master-sub-category/{id}', 'CategoryController@master_sub_category_update')->name('master-sub-category.update');
    Route::delete('/master-sub-category/{id}', 'CategoryController@master_sub_category_delete')->name('master-sub-category.delete');
    Route::get('/master-sub-category/status/{id}/{status}', 'CategoryController@master_sub_category_status')->name('master-sub-category.status');

    //sub sub category
    Route::get('/master-sub-sub-category', 'CategoryController@master_sub_sub_category_index')->name('master-sub-sub-category');
    Route::get('/master-sub-sub-category/add', 'CategoryController@master_sub_sub_category_add')->name('master-sub-sub-category.add');
    Route::post('/master-sub-sub-category', 'CategoryController@master_sub_sub_category_store')->name('master-sub-sub-category.store');
    Route::get('/master-sub-sub-category/{id}', 'CategoryController@master_sub_sub_category_edit')->name('master-sub-sub-category.edit');
    Route::put('/master-sub-sub-category/{id}', 'CategoryController@master_sub_sub_category_update')->name('master-sub-sub-category.update');
    Route::delete('/master-sub-sub-category/{id}', 'CategoryController@master_sub_sub_category_delete')->name('master-sub-sub-category.delete');
    Route::get('/master-sub-sub-category/status/{id}/{status}', 'CategoryController@master_sub_sub_category_status')->name('master-sub-sub-category.status');

    //products
    Route::get('/master-product', 'ProductController@master_product_index')->name('master-product');
    Route::get('/master-product/datasource', 'ProductController@master_product_datasource')->name('master-product-get');
    Route::get('/master-product/status/{id}/{status}', 'ProductController@master_product_status')->name('product.status');
    Route::get('/master-product/add', 'ProductController@master_product_add')->name('master-product.add');
    Route::get('/get-merchants/{id}', 'ProductController@get_merchants');
    Route::get('/get-sub-category/{id}', 'ProductController@get_sub_category');
    Route::get('/get-sub-sub-category/{id}', 'ProductController@get_sub_sub_category');
    Route::post('/master-product', 'ProductController@master_product_store')->name('master-product.store');
    Route::get('/master-product/{id}', 'ProductController@master_product_edit')->name('master-product.edit');
    Route::put('/master-product/{id}', 'ProductController@master_product_update')->name('master-product.update');
    Route::delete('/master-product/{id}', 'ProductController@master_product_delete')->name('master-product.delete');

    //payment
    Route::get('/master-payment', 'PaymentController@master_payment_index')->name('master-payment');
    Route::get('/master-payment/status/{id}/{status}', 'PaymentController@master_payment_status')->name('master-payment.status');
    Route::get('/master-payment/add', 'PaymentController@master_payment_add')->name('master-payment.add');
    Route::post('/master-payment/add', 'PaymentController@master_payment_store')->name('master-payment.store');

    //user admin
    Route::get('/master-user', 'UserController@master_user_index')->name('master-user');
    Route::get('/master-user/status/{id}/{status}', 'UserController@master_user_status')->name('master-user.status');
    Route::get('/master-user/add', 'UserController@master_user_add')->name('master-user.add');
    Route::post('/master-user/add', 'UserController@master_user_store')->name('master-user.store');
    Route::get('/master-user/{id}', 'UserController@master_user_edit')->name('master-user.edit');
    Route::put('/master-user/{id}', 'UserController@master_user_update')->name('master-user.update');
    Route::delete('/master-user/{id}', 'UserController@master_user_delete')->name('master-user.delete');

    //user merchant
    Route::get('/master-merchant', 'MerchantController@master_merchant_index')->name('master-merchant');
    Route::get('/master-merchant/add', 'MerchantController@master_merchant_add')->name('master-merchant.add');
    Route::post('/master-merchant/add', 'MerchantController@master_merchant_store')->name('master-merchant.store');
    Route::get('/get-sub-category/{id}', function ($id) {
      $course = Category::where('parent_id', $id)->where('position', 1)->get();
      return response()->json($course);
    });
    Route::get('/master-merchant/{id}', 'MerchantController@master_merchant_edit')->name('master-merchant.edit');
    Route::delete('/master-merchant/{id}', 'MerchantController@master_merchant_delete')->name('master-merchant.delete');
    Route::put('/master-merchant/{id}', 'MerchantController@master_merchant_update')->name('master-merchant.update');
    Route::get('/master-merchant/status/{id}/{status}', 'MerchantController@master_merchant_status')->name('master-merchant.status');

    Route::get('settings', 'SystemController@settings')->name('settings');
    Route::post('settings', 'SystemController@settings_update');
    Route::post('settings-password', 'SystemController@settings_password_update')->name('settings-password');
    Route::get('/get-restaurant-data', 'SystemController@restaurant_data')->name('get-restaurant-data');

    //banner
    Route::resource('banner', 'BannerController');
    Route::get('/master-banner/status/{id}/{status}', 'BannerController@master_banner_status')->name('banner.status');
    Route::resource('coupon', 'CouponController');
    Route::get('/master-coupon/status/{id}/{status}', 'CouponController@master_coupon_status')->name('coupon.status');
    Route::resource('courier', 'CourierController');
    Route::get('/master-courier/status/{id}/{status}', 'CourierController@master_courier_status')->name('courier.status');

    //tac
    Route::get('tac', 'TACController@tac_index')->name('tac');
    Route::get('tac/status/{id}/{status}', 'TACController@tac_status')->name('tac.status');
    Route::get('tac/create', 'TACController@tac_create')->name('tac.create');
    Route::post('tac/store', 'TACController@tac_store')->name('tac.store');
    Route::get('tac/edit/{id}', 'TACController@tac_edit')->name('tac.edit');
    Route::put('tac/update/{id}', 'TACController@tac_update')->name('tac.update');
    Route::delete('tac/delete/{id}', 'TACController@tac_delete')->name('tac.delete');

    //privacy policy
    Route::get('privacy-policy', 'PrivacyController@privacy_index')->name('privacy-policy');
    Route::get('privacy-policy/status/{id}/{status}', 'PrivacyController@privacy_status')->name('privacy-policy.status');
    Route::get('privacy-policy/create', 'PrivacyController@privacy_create')->name('privacy-policy.create');
    Route::post('privacy-policy/store', 'PrivacyController@privacy_store')->name('privacy-policy.store');
    Route::get('privacy-policy/edit/{id}', 'PrivacyController@privacy_edit')->name('privacy-policy.edit');
    Route::put('privacy-policy/update/{id}', 'PrivacyController@privacy_update')->name('privacy-policy.update');
    Route::delete('privacy-policy/delete/{id}', 'PrivacyController@privacy_delete')->name('privacy-policy.delete');

    //faq
    Route::get('faq', 'FaqController@faq_index')->name('faq');
    Route::get('faq/status/{id}/{status}', 'FaqController@faq_status')->name('faq.status');
    Route::get('faq/create', 'FaqController@faq_create')->name('faq.create');
    Route::post('faq/store', 'FaqController@faq_store')->name('faq.store');
    Route::get('faq/edit/{id}', 'FaqController@faq_edit')->name('faq.edit');
    Route::put('faq/update/{id}', 'FaqController@faq_update')->name('faq.update');
    Route::delete('faq/delete/{id}', 'FaqController@faq_delete')->name('faq.delete');

    //general
    Route::get('general', 'GeneralController@general_index')->name('general');
    Route::get('general/maintenance/{id}/{maintenance_mode}', 'GeneralController@general_maintenance')->name('general.maintenance');
    Route::post('general/store', 'GeneralController@general_store')->name('general.store');
    Route::put('general/update/{id}', 'GeneralController@general_update')->name('general.update');

    //log
    Route::get('log/order', 'LogOrderController@index')->name('log.order');
  });
});
