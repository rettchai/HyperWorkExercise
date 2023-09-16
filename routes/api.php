<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ApiAuthController;
use App\Http\Controllers\Api\Orders\OrdersController;
use App\Http\Controllers\Api\Products\ProductsController;

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

Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);

Route::post('/orders/create', [OrdersController::class, 'createOrders'])->name('order.create')->middleware('auth:sanctum');
Route::get('/orders', [OrdersController::class, 'Orders'])->name('Orders')->middleware('auth:sanctum');

Route::get('/products', [ProductsController::class, 'index'])->name('products')->middleware('auth:sanctum');

Route::post('/products/create', [ProductsController::class, 'create'])->name('products.create')->middleware(['auth:sanctum','verified.product']);
Route::put('/products/update/{id}', [ProductsController::class, 'update'])->name('products.edit')->middleware('auth:sanctum','verified.product');


