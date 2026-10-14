<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\StandeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('standees.index'));

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('standees.index'))->name('dashboard');

    Route::get('/standees', [StandeeController::class, 'index'])->name('standees.index');
    Route::put('/standees/{standee}', [StandeeController::class, 'update'])->name('standees.update');
    Route::post('/standees', [StandeeController::class, 'store'])->name('standees.store');
    Route::get('/standees/{standee}/qr', [StandeeController::class, 'qr'])->name('standees.qr');
    Route::get('/standees-download-all', [StandeeController::class, 'downloadAll'])->name('standees.downloadAll');
    Route::get('/standees/{standee}/edit', [StandeeController::class, 'edit'])->name('standees.edit');
    Route::put('/standees/{standee}/page', [StandeeController::class, 'updatePage'])->name('standees.updatePage');
    Route::post('/standees/{standee}/links', [StandeeController::class, 'storeLink'])->name('standees.links.store');
    Route::delete('/standees/{standee}/links/{link}', [StandeeController::class, 'destroyLink'])->name('standees.links.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Landing page ke button par click (public, login ki zaroorat nahi)
Route::get('/go/{link}', [RedirectController::class, 'click'])->name('link.click');

// Hamesha sab se neeche rakhein
Route::get('/{code}', RedirectController::class)
    ->where('code', 's[0-9]+')
    ->name('qr.redirect');