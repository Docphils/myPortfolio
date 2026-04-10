<?php

namespace App\Livewire\Pages;

use App\Models\About;
use App\Models\Contact;
use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class DashboardPage extends Component
{
    public function render()
    {
        return view('livewire.pages.dashboard-page', [
            'about' => About::query()->first(),
            'totalProjects' => Project::query()->count(),
            'totalMessages' => Contact::query()->count(),
            'totalUsers' => User::query()->count(),
        ]);
    }
}
