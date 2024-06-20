<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;



Route::get('/', [AboutController::class, 'welcome'])->name('welcome');




Route::get('/dashboard', [AboutController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // About Routes
    Route::post('/abouts', [AboutController::class, 'store'])->name('abouts.store');
    Route::get('/abouts/create', [AboutController::class, 'create'])->name('abouts.create');  // New Route
    Route::get('/abouts/{about}/edit', [AboutController::class, 'edit'])->name('abouts.edit');
    Route::put('/abouts/{about}', [AboutController::class, 'update'])->name('abouts.update');
    Route::delete('/abouts/{about}', [AboutController::class, 'destroy'])->name('abouts.destroy');
});



require __DIR__.'/auth.php';
