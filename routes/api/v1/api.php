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
        Route::get('/{prefix}', 'OrderController@get_order_detail');
        Route::put('/{prefix}', 'OrderController@update_order');
    });
    Route::group(['prefix' => 'blog-categories'], function () {
        Route::get('/', 'BlogCategoryController@get_blog_categories');
    });
    Route::group(['prefix' => 'blogs'], function () {
        Route::get('/', 'BlogController@get_blogs');
        Route::get('/{slug}', 'BlogController@get_blog_detail');
    });
    Route::group(['prefix' => 'payments'], function () {
        Route::get('/', 'PaymentController@get_payments');
    });
    Route::group(['prefix' => 'faq'], function () {
        Route::get('/', 'FaqController@get_faqs');
    });
    Route::get('distance', 'ConfigController@distance');
    Route::get('/generate-slug-product', 'ProductController@generate_slug_products');
    Route::get('/product-list-merchant-landing/{slug}', 'ProductController@get_product_list_merchant_landing');
    Route::get('/product-recomendations', 'ProductController@get_product_recomendation');
    Route::post('/cart-validation', 'ProductController@cart_validation');
    Route::get('/merchant-groups', 'MerchantGroupController@get_merchant_groups');
    Route::get('/search', 'ProductController@search_product');
    Route::get('/search/products', 'ProductController@get_products_from_search');
    Route::get('/search/merchants', 'MerchantController@get_merchants_from_search');

    Route::group(['prefix' => 'travel'], function () {
        Route::get('/{slug}', 'TravelController@get_travel_detail');
        Route::get('/count', 'TravelController@get_travel_route');
        Route::post('/', 'TravelController@travel_store');
    });

    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/{slug}', 'CouponController@getCoupon');
    });
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
    Route::middleware('auth:sanctum')->group(function(){
        Route::get('profile', 'AuthController@profile');
        Route::post('logout','AuthController@logout');
    });
});
