<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::group(['namespace' => 'Merchant', 'as' => 'merchant.'], function () {
  /*authentication*/
  Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('login', 'LoginController@submit')->name('login.submit');
    Route::get('register', 'LoginController@register')->name('register');
    Route::post('register-submit', 'LoginController@register_submit')->name('register.submit');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::get('/get-sub-category/{id}', function ($id) {
      $course = Category::where('parent_id', $id)->where('position', 1)->get();
      return response()->json($course);
    });
    Route::get('thanks/{id}', function ($id) {
      $vendor = Vendor::where('id', $id)->first();
      $details = [
        'button' => $vendor->auth_token
      ];
      Mail::to($vendor->email)->send(new \App\Mail\SendEmailRegister($details));
      return view('merchant.auth.thanks', compact('vendor'));
    })->name('thanks');
    Route::get('/verify/{id}', 'LoginController@verify')->name('verify');
    Route::get('/forget', function(){
        return view('merchant.auth.forget');
    })->name('forget');
    Route::post('forget-submit', 'LoginController@forget')->name('forget.submit');
    Route::post('forget-submit-newpassword', 'LoginController@forgetNewPassword')->name('forget.newpassword');
    Route::get('/forgetThanks', function(){
        return view('merchant.auth.thanksForget');
    })->name('forget.thanks');
    Route::get('/forget/{id}', function($id){
        $auth_token = $id;
        return view('merchant.auth.forgetPassword',compact('auth_token'));
    })->name('forget.password');
  });
  /*authentication*/
  Route::group(['middleware' => ['auth:merchant']], function () {
    //dashboard
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');

    Route::get('settings', 'SystemController@settings')->name('settings');
    Route::post('settings', 'SystemController@settings_update');
    Route::post('settings-password', 'SystemController@settings_password_update')->name('settings-password');
    Route::get('/get-restaurant-data', 'SystemController@restaurant_data')->name('get-restaurant-data');

    Route::get('/master-banner', 'BannerController@master_banner_index')->name('master-banner');
    Route::get('/master-banner-status/{id}/{status}', 'BannerController@master_banner_status')->name('master-banner.status');
    Route::get('/master-banner/add', 'BannerController@master_banner_add')->name('master-banner.add');
    Route::post('/master-banner/store', 'BannerController@master_banner_store')->name('master-banner.store');
    Route::get('master-banner/{id}', 'BannerController@master_banner_edit')->name('master-banner.edit');
    Route::put('/master-banner/{id}', 'BannerController@master_banner_update')->name('master-banner.update');
    Route::delete('master-banner/{id}', 'BannerController@master_banner_delete')->name('master-banner.delete');

    Route::get('master-coupon', 'CouponController@master_coupon_index')->name('master-coupon');
    Route::get('comming-soon', function() {
        return view('merchant.coupon.soon');
    })->name('comming-soon');
    Route::get('master-coupon-status/{id}/{status}', 'CouponController@master_coupon_status')->name('master-coupon.status');
    Route::get('master-coupon/create', 'CouponController@master_coupon_create')->name('master-coupon.create');
    Route::post('master-coupon/store', 'CouponController@master_coupon_store')->name('master-coupon.store');
    Route::get('master-coupon/{id}', 'CouponController@master_coupon_edit')->name('master-coupon.edit');
    Route::put('master-coupon/{id}', 'CouponController@master_coupon_update')->name('master-coupon.update');
    Route::delete('master-coupon/{id}', 'CouponController@master_coupon_delete')->name('master-coupon.delete');

    Route::get('master-merchant', 'MerchantController@master_merchant_edit')->name('master-merchant.edit');
    Route::put('/master-merchant/{id}', 'MerchantController@master_merchant_update')->name('master-merchant.update');
    Route::get('/master-merchant/status/{id}/{active}', 'MerchantController@master_merchant_status')->name('master-merchant.status');

    Route::get('/master-product', 'ProductController@master_product_index')->name('master-product');
    Route::get('/master-product/status/{id}/{status}', 'ProductController@master_product_status')->name('product.status');
    Route::get('/master-product/favorite/{id}/{favorite}', 'ProductController@master_product_favorite')->name('product.favorite');
    Route::get('/master-product/add', 'ProductController@master_product_add')->name('master-product.add');
    Route::post('/master-product/add', 'ProductController@master_product_store')->name('master-product.store');
    Route::get('/master-product/{id}', 'ProductController@master_product_edit')->name('master-product.edit');
    Route::put('/master-product/{id}', 'ProductController@master_product_update')->name('master-product.update');
    Route::delete('/master-product/{id}', 'ProductController@master_product_delete')->name('master-product.delete');

    Route::get('/orders/all', 'OrderController@index')->name('master-order');
    Route::get('/orders/detail/{order:prefix}', 'OrderController@detail')->name('orders.detail');
  });
});
