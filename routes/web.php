<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectController;




Route::get('/', function() {
    $aboutController = new AboutController();

    // Get data from welcome method
    $welcomeData = $aboutController->welcome()->getData();
    
    // Get data from index method
    $homeData = $aboutController->home()->getData();

    // Merge the data arrays
    $data = array_merge($welcomeData, $homeData);

    return view('welcome', $data);
})->name('welcome');




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
    //Projects Routes
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

});

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');




require __DIR__.'/auth.php';
