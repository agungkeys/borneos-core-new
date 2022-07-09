<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Courier', 'as' => 'courier.'], function () {
  /*authentication*/
  Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('login', 'LoginController@submit')->name('login.submit');
    Route::get('logout', 'LoginController@logout')->name('logout');
  });
  /*authentication*/
  Route::group(['middleware' => ['auth:courier']], function () {
    //dashboard
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');
  });
});
