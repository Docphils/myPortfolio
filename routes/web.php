<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Pages\AboutFormPage;
use App\Livewire\Pages\Admin\CaseStudiesManager;
use App\Livewire\Pages\Admin\ProjectsManager;
use App\Livewire\Pages\Admin\TestimonialsManager;
use App\Livewire\Pages\CaseStudyShowPage;
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
Route::get('/case-studies/{caseStudy:slug}', CaseStudyShowPage::class)->name('case-studies.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardPage::class)->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/abouts/create', AboutFormPage::class)->name('abouts.create');
    Route::get('/abouts/{about}/edit', AboutFormPage::class)->name('abouts.edit');

    Route::get('/contacts', ContactsIndexPage::class)->name('contacts.index');
    Route::get('/contacts/{contact}', ContactShowPage::class)->name('contacts.show');

    Route::get('/admin/projects', ProjectsManager::class)->name('admin.projects.index');
    Route::get('/admin/projects/create', ProjectFormPage::class)->name('admin.projects.create');
    Route::get('/admin/projects/{project}/edit', ProjectFormPage::class)->name('admin.projects.edit');
    Route::get('/admin/case-studies', CaseStudiesManager::class)->name('admin.case-studies.index');
    Route::get('/admin/testimonials', TestimonialsManager::class)->name('admin.testimonials.index');
});

require __DIR__.'/auth.php';
