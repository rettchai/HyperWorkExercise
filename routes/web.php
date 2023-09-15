<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\GoogleController;
use App\Http\Controllers\Api\Auth\ApiAuthController;
use App\Http\Controllers\Api\Auth\FacebookController;
use App\Http\Controllers\Api\Auth\LaravelPassportController;

Route::prefix('auth')->group(function () {
    //redirect
    Route::prefix('redirect')->group(function () {
        Route::get('/google', [GoogleController::class,'getRedirect'])->name('google.login');
        Route::get('/passport', [LaravelPassportController::class,'getRedirect'])->name('passport.login');
        Route::get('/facebook', [FacebookController::class,'getRedirect'])->name('facebook.login');
    });
    //redirect

    Route::prefix('callback')->group(function () {
        Route::get('/google', [GoogleController::class,'getCallback']);
        Route::get('/passport', [LaravelPassportController::class,'getCallback']);
        Route::get('/facebook', [FacebookController::class,'getCallback']);
    });


});


Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
