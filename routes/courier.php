<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Courier', 'as' => 'courier.'], function () {
  /*authentication*/
  Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('login', 'LoginController@submit')->name('login.submit');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::get('register', 'LoginController@register')->name('register');
    Route::post('register-submit', 'LoginController@register_submit')->name('register.submit');
    Route::get('thanks', 'LoginController@thanks')->name('thanks.page');
  });
  /*authentication*/
  Route::group(['middleware' => ['auth:courier']], function () {
    //dashboard
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/orders/all', 'OrderController@index')->name('master-order');
    Route::get('/orders/detail/{order:prefix}', 'OrderController@detail')->name('master-order.detail');
    Route::put('/order/detail/{order:prefix}', 'OrderController@updateDeliverStatus')->name('master-order.detail.update');
  });
});
