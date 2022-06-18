<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api\v1'], function () {
  Route::group(['prefix' => 'banners'], function () {
    Route::get('/', 'BannerController@get_banners');
  });
  Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'CategoryController@get_categories');
  });
  Route::group(['prefix' => 'merchants'], function () {
    Route::get('/', 'MerchantController@get_merchants');
  });
});
