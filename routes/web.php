<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Pages\AboutFormPage;
use App\Livewire\Pages\Admin\CaseStudiesManager;
use App\Livewire\Pages\Admin\ProjectsManager;
use App\Livewire\Pages\Admin\TestimonialsManager;
use App\Models\CaseStudy;
use App\Models\Project;
use App\Livewire\Pages\CaseStudyShowPage;
use App\Livewire\Pages\ContactShowPage;
use App\Livewire\Pages\ContactsIndexPage;
use App\Livewire\Pages\DashboardPage;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\ProjectFormPage;
use App\Livewire\Pages\ProjectsIndexPage;
use App\Livewire\Pages\ProjectShowPage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Carbon;

Route::get('/', HomePage::class)->name('welcome');

Route::get('/projects', ProjectsIndexPage::class)->name('projects.index');
Route::get('/projects/{project}', ProjectShowPage::class)->name('projects.show');
Route::get('/case-studies/{caseStudy:slug}', CaseStudyShowPage::class)->name('case-studies.show');
Route::get('/sitemap.xml', function () {
    $xml = Cache::remember('seo:sitemap.xml:v1', now()->addHour(), function (): string {
        $urls = [
            [
                'loc' => route('welcome'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '1.0',
            ],
            [
                'loc' => route('projects.index'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.9',
            ],
        ];

        Project::query()
            ->published()
            ->latest('published_at')
            ->latest('id')
            ->get()
            ->each(function (Project $project) use (&$urls): void {
                $lastmod = $project->updated_at ?: $project->published_at ?: $project->created_at;
                $urls[] = [
                    'loc' => route('projects.show', $project),
                    'lastmod' => optional($lastmod)->toAtomString() ?? Carbon::now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.8',
                ];
            });

        CaseStudy::query()
            ->published()
            ->ordered()
            ->get()
            ->each(function (CaseStudy $caseStudy) use (&$urls): void {
                $lastmod = $caseStudy->updated_at ?: $caseStudy->published_at ?: $caseStudy->created_at;
                $urls[] = [
                    'loc' => route('case-studies.show', $caseStudy),
                    'lastmod' => optional($lastmod)->toAtomString() ?? Carbon::now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.8',
                ];
            });

        $xmlBody = collect($urls)->map(static function (array $url): string {
            return '<url>'
                .'<loc>'.e($url['loc']).'</loc>'
                .'<lastmod>'.e($url['lastmod']).'</lastmod>'
                .'<changefreq>'.e($url['changefreq']).'</changefreq>'
                .'<priority>'.e($url['priority']).'</priority>'
                .'</url>';
        })->implode('');

        return '<?xml version="1.0" encoding="UTF-8"?>'
            .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'
            .$xmlBody
            .'</urlset>';
    });

    return Response::make($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
})->name('sitemap');

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
