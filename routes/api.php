<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\Auth\GoogleController;
use App\Http\Controllers\Api\Auth\ApiAuthController;
use App\Http\Controllers\Api\Auth\FacebookController;
use App\Http\Controllers\Api\Orders\OrdersController;
use App\Http\Controllers\Api\Products\ProductsController;
use App\Http\Controllers\Api\Auth\LaravelPassportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::post('/register', [ApiAuthController::class, 'register'])->name('api.register');
// Route::post('/login', [ApiAuthController::class, 'login'])->name('api.login');


Route::prefix('auth')->group(function () {
    //redirect
    Route::prefix('redirect')->group(function () {
        Route::get('/google', [GoogleController::class,'getRedirect'])->name('google.login.api');
        Route::get('/passport', [LaravelPassportController::class,'getRedirect'])->name('passport.login.api');
        Route::get('/facebook', [FacebookController::class,'getRedirect'])->name('facebook.login.api');
    });
    //redirect

    Route::prefix('callback')->group(function () {
        Route::get('/google', [GoogleController::class,'getCallback']);
        Route::get('/passport', [LaravelPassportController::class,'getCallback']);
        Route::get('/facebook', [FacebookController::class,'getCallback']);
    });
});



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/me', [AuthController::class, 'me']);


    Route::post('/orders/create', [OrdersController::class, 'createOrders'])->name('order.create');
    Route::get('/orders', [OrdersController::class, 'Orders'])->name('Orders');


    Route::get('/products', [ProductsController::class, 'index'])->name('products')->middleware('auth:sanctum');

    Route::post('/products/create', [ProductsController::class, 'create'])->name('products.create')->middleware('verified.product');
    Route::put('/products/update/{id}', [ProductsController::class, 'update'])->name('products.edit')->middleware('verified.product');

});
