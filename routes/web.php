<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\StandeeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;

// Public home page
Route::get('/', fn () => view('home'))->name('home');

// Login (max 5 attempts per minute)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Every user: only their own standees (ownership checked in the controller)
    Route::get('/standees', [StandeeController::class, 'index'])->name('standees.index');
    Route::post('/standees', [StandeeController::class, 'store'])->name('standees.store');
    Route::put('/standees/{standee}', [StandeeController::class, 'update'])->name('standees.update');
    Route::get('/standees/{standee}/qr', [StandeeController::class, 'qr'])->name('standees.qr');
    Route::get('/standees-download-all', [StandeeController::class, 'downloadAll'])->name('standees.downloadAll');
    Route::get('/standees/{standee}/edit', [StandeeController::class, 'edit'])->name('standees.edit');
    Route::put('/standees/{standee}/page', [StandeeController::class, 'updatePage'])->name('standees.updatePage');
    Route::post('/standees/{standee}/links', [StandeeController::class, 'storeLink'])->name('standees.links.store');
    Route::delete('/standees/{standee}/links/{link}', [StandeeController::class, 'destroyLink'])->name('standees.links.destroy');

    // Admin only: manage users and reassign standees
    Route::middleware('admin')->group(function () {
        Route::post('/standees-assign', [StandeeController::class, 'assign'])->name('standees.assign');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

// Public: landing page button click
Route::get('/go/{link}', [RedirectController::class, 'click'])->name('link.click');

// Always keep last
Route::get('/{code}', RedirectController::class)
    ->where('code', 's[0-9]+')
    ->name('qr.redirect');
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordResetController::class, 'request'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'email'])->middleware('throttle:6,1')->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'update'])->name('password.update');
});