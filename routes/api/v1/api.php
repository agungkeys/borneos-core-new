<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api\v1'], function () {
  Route::group(['prefix' => 'banners'], function () {
    Route::get('/{status}/{type}/{sort}', 'BannerController@get_banners');
  });
  Route::group(['prefix' => 'categories'], function () {
    Route::get('/{status}/{sort}', 'CategoryController@get_categories');
  });
});
