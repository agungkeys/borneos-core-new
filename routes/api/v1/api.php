<?php

use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\CategoryController;
use Illuminate\Support\Facades\Route;


Route::get('/master-category', [CategoryController::class, 'master_category_index']);
Route::get('/master-banner', [BannerController::class, 'master_banner_index']);
