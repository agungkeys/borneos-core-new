<?php
  use Illuminate\Support\Facades\Route;

  Route::group(['namespace' => 'Merchant', 'as' => 'merchant.'], function () {
    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
      Route::get('login', 'LoginController@login')->name('login');
      Route::post('login', 'LoginController@submit')->name('login.submit');
      Route::get('logout', 'LoginController@logout')->name('logout');
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
      Route::get('master-coupon-status/{id}/{status}', 'CouponController@master_coupon_status')->name('master-coupon.status');
      Route::get('master-coupon/create', 'CouponController@master_coupon_create')->name('master-coupon.create');
      Route::post('master-coupon/store', 'CouponController@master_coupon_store')->name('master-coupon.store');
    });

    // Route::middleware(['auth:vendor'])->group(function(){
    //   Route::get('/', 'DashboardController@dashboard')->name('dashboard');
    // });
    // Route::group(['middleware' => ['vendor']], function () {
      // Route::get('/', 'DashboardController@dashboard')->name('dashboard');
      // Route::get('/',[DashboardController::class, 'dashboard']);
    // });
  });
