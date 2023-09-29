<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        // Route::resource('/costomer',CostomerController::class);
        // Route::resource('/categorie',CategorieController::class);
        // Route::resource('/product',ProductController::class);
        Route::resource('/create/cart',ProductController::class)->name('showCartCustomer','cart');
        // Route::resource('/orders',OrderController::class);
        // Route::resource('/countries',CountrieController::class);
        // Route::resource('/cities',CitieController::class);
        // Route::resource('/states',StateController::class);

    });
