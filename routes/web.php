<?php

use App\Livewire\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Api\Auth\GoogleController;
use App\Http\Controllers\Api\Auth\ApiAuthController;
use App\Http\Controllers\Api\Auth\FacebookController;
use App\Http\Controllers\Api\Auth\LaravelPassportController;
use App\Livewire\Auth\LoginController;

Route::prefix('auth')->group(function () {
    //redirect
    Route::prefix('redirect')->group(function () {
        // Route::get('/google', [GoogleController::class,'getRedirect'])->name('google.login');
        // Route::get('/passport', [LaravelPassportController::class,'getRedirect'])->name('passport.login');
        // Route::get('/facebook', [FacebookController::class,'getRedirect'])->name('facebook.login');
    });
    //redirect

    Route::prefix('callback')->group(function () {
        // Route::get('/google', [GoogleController::class,'getCallback']);
        // Route::get('/passport', [LaravelPassportController::class,'getCallback']);
        // Route::get('/facebook', [FacebookController::class,'getCallback']);


    });


});

// Route::get('/test', [TestController::class,'test']);

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->name('dashboard');

// Auth::routes();


Route::get('/home',HomeController::class)->name('home');
Route::get('/login',LoginController::class)->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


