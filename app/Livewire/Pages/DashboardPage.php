<?php

namespace App\Livewire\Pages;

use App\Models\About;
use App\Models\CaseStudy;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Dashboard')]
class DashboardPage extends Component
{
    public function render()
    {
        $recentContacts = Contact::query()->latest()->take(5)->get();
        $recentProjects = Project::query()->latest()->take(5)->get();

        return view('livewire.pages.dashboard-page', [
            'about' => About::query()->first(),
            'totalProjects' => Project::query()->count(),
            'publishedProjects' => Project::query()->published()->count(),
            'totalMessages' => Contact::query()->count(),
            'totalUsers' => User::query()->count(),
            'totalCaseStudies' => CaseStudy::query()->count(),
            'publishedCaseStudies' => CaseStudy::query()->published()->count(),
            'totalTestimonials' => Testimonial::query()->count(),
            'publishedTestimonials' => Testimonial::query()->published()->count(),
            'recentContacts' => $recentContacts,
            'recentProjects' => $recentProjects,
        ]);
    }
}
