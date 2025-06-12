<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::get('/signup', [AuthController::class, 'getSignup'])->name('signup');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/purchase/{product}', [PurchaseController::class, 'purchase'])->name('purchase');
    Route::any('/purchase/{transaction_id}/verify', [PurchaseController::class, 'verification'])
        ->withoutMiddleware([VerifyCsrfToken::class])
        ->name('purchase.verify');
    Route::get('/purchase/{transaction_id}/response', [PurchaseController::class, 'show'])->name('purchase.response');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::any('/purchase/{transaction_id}/notify', [PurchaseController::class, 'notification'])->name('purchase.notify');
