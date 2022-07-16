<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api\V1'], function () {
  Route::group(['prefix' => 'banners'], function () {
    Route::get('/', 'BannerController@get_banners');
  });
  Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'CategoryController@get_categories');
  });
  Route::group(['prefix' => 'merchants'], function () {
    Route::get('/', 'MerchantController@get_merchants');
    Route::get('/{slug}', 'MerchantController@get_merchant_detail');
  });
  Route::group(['prefix' => 'products'], function () {
    Route::get('/', 'ProductController@get_products');
  });
  Route::group(['prefix' => 'orders'], function () {
    Route::post('/', 'OrderController@order_store');
  });
});
