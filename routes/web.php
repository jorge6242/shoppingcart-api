<?php

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

Route::prefix('api')->group(function () {
    Route::post('/login', 'PassportController@login');
    Route::post('/register', 'PassportController@register');
    Route::middleware('auth:api')->group(function () {
        Route::resource('/product', 'ProductController');
        Route::get('/product-search', 'ProductController@search');
        Route::resource('/user', 'UserController');
        Route::resource('/category', 'CategoryController');
        Route::resource('/cart', 'CartController');
        Route::put('/purchase', 'CartController@purchase');
    });
});