<?php

use App\Http\Controllers\UtilsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/get-merchants/{id}', [UtilsController::class, 'get_merchants']);
Route::get('/get-sub-category/{id}', [UtilsController::class, 'get_sub_category']);
Route::get('/get-sub-sub-category/{id}', [UtilsController::class, 'get_sub_sub_category']);
Auth::routes();

Route::get('/landing', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
