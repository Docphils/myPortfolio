<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Pages\AboutFormPage;
use App\Livewire\Pages\ContactShowPage;
use App\Livewire\Pages\ContactsIndexPage;
use App\Livewire\Pages\DashboardPage;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\ProjectFormPage;
use App\Livewire\Pages\ProjectsIndexPage;
use App\Livewire\Pages\ProjectShowPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('welcome');

Route::get('/projects', ProjectsIndexPage::class)->name('projects.index');
Route::get('/projects/{project}', ProjectShowPage::class)->name('projects.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardPage::class)->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/abouts/create', AboutFormPage::class)->name('abouts.create');
    Route::get('/abouts/{about}/edit', AboutFormPage::class)->name('abouts.edit');

    Route::get('/projects/create', ProjectFormPage::class)->name('projects.create');
    Route::get('/projects/{project}/edit', ProjectFormPage::class)->name('projects.edit');

    Route::get('/contacts', ContactsIndexPage::class)->name('contacts.index');
    Route::get('/contacts/{contact}', ContactShowPage::class)->name('contacts.show');
});

require __DIR__.'/auth.php';
