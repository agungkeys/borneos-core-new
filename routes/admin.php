<?php

use App\Http\Controllers\Admin\BannerController;
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
  Route::group(['middleware' => ['admin']], function () {
    //dashboard
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');
    //categories
    Route::get('/master-category', 'CategoryController@master_category_index')->name('master-category');
    Route::get('/master-category/add', 'CategoryController@master_category_add')->name('master-category.add');
    Route::post('/master-category/add', 'CategoryController@master_category_store')->name('master-category.store');
    Route::get('/master-category/{id}', 'CategoryController@master_category_edit')->name('master-category.edit');
    Route::put('/master-category/{id}', 'CategoryController@master_category_update')->name('master-category.update');
    Route::delete('/master-category/{id}', 'CategoryController@master_category_delete')->name('master-category.delete');

    Route::get('/master-sub-category', 'CategoryController@master_sub_category_index')->name('master-sub-category');
    Route::get('/master-sub-category/add', 'CategoryController@master_sub_category_add')->name('master-sub-category.add');
    Route::post('/master-sub-category/add', 'CategoryController@master_sub_category_store')->name('master-sub-category.store');
    Route::get('/master-sub-category/{id}', 'CategoryController@master_sub_category_edit')->name('master-sub-category.edit');
    Route::put('/master-sub-category/{id}', 'CategoryController@master_sub_category_update')->name('master-sub-category.update');
    Route::delete('/master-sub-category/{id}', 'CategoryController@master_sub_category_delete')->name('master-sub-category.delete');

    Route::get('/master-sub-sub-category', 'CategoryController@master_sub_sub_category_index')->name('master-sub-sub-category');
    Route::get('/master-sub-sub-category/add', 'CategoryController@master_sub_sub_category_add')->name('master-sub-sub-category.add');
    Route::post('/master-sub-sub-category', 'CategoryController@master_sub_sub_category_store')->name('master-sub-sub-category.store');





    Route::get('settings', 'SystemController@settings')->name('settings');
    Route::post('settings', 'SystemController@settings_update');
    Route::post('settings-password', 'SystemController@settings_password_update')->name('settings-password');
    Route::get('/get-restaurant-data', 'SystemController@restaurant_data')->name('get-restaurant-data');

    Route::resource('banner', 'BannerController');

  });
});

