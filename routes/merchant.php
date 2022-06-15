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
    });

    // Route::middleware(['auth:vendor'])->group(function(){
    //   Route::get('/', 'DashboardController@dashboard')->name('dashboard');
    // });
    // Route::group(['middleware' => ['vendor']], function () {
      // Route::get('/', 'DashboardController@dashboard')->name('dashboard');
      // Route::get('/',[DashboardController::class, 'dashboard']);
    // });
  });
