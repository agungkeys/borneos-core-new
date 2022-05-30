<?php
  use Illuminate\Support\Facades\Route;

  Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
      Route::get('login', 'LoginController@login')->name('login');
      Route::post('login', 'LoginController@submit')->middleware('actch');
      Route::get('logout', 'LoginController@logout')->name('logout');
    });
    /*authentication*/

    Route::group(['middleware' => ['admin']], function () {

      Route::get('settings', 'SystemController@settings')->name('settings');
      Route::post('settings', 'SystemController@settings_update');
      Route::post('settings-password', 'SystemController@settings_password_update')->name('settings-password');
      Route::get('/get-restaurant-data', 'SystemController@restaurant_data')->name('get-restaurant-data');

      //dashboard
      Route::get('/', 'DashboardController@dashboard')->name('dashboard');
    });
  });
