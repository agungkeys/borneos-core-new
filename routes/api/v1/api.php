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
    Route::get('/{slug}', 'MerchantController@get_merchant');
  });
  Route::group(['prefix' => 'products'], function () {
    Route::get('/', 'ProductController@get_products');
    Route::get('/{slug}', 'ProductController@get_product_detail');
  });
  Route::group(['prefix' => 'orders'], function () {
    Route::post('/', 'OrderController@order_store');
  });
  Route::get('/generate-slug-product', 'ProductController@generate_slug_products');
  Route::get('/product-list-merchant-landing/{slug}', 'ProductController@get_product_list_merchant_landing');
});
