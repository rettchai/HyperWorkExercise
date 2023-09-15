<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\ApiAuthController;

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


// Route::prefix('auth')->group(function () {
    //redirect
    // Route::prefix('redirect')->group(function () {
    //     Route::get('/google', [GoogleController::class,'getRedirect'])->name('google.login');
    //     Route::get('/passport', [LaravelPassportController::class,'getRedirect'])->name('passport.login');
    // });
    //redirect

    //callback
    // Route::prefix('callback')->group(function () {
    //     Route::get('/google', [GoogleController::class,'getCallback']);
    //     Route::get('/passport', [LaravelPassportController::class,'getCallback']);
    // });
    //callback

// });

// Route::post('/register', [ApiAuthController::class, 'register'])->name('api.register');
// Route::post('/login', [ApiAuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});
