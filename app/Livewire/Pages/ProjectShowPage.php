<?php

namespace App\Livewire\Pages;

use App\Models\Project;
use Livewire\Component;

class ProjectShowPage extends Component
{
    public Project $project;

    public function mount(Project $project): void
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.pages.project-show-page')->layout('layouts.portfolio');
    }
}
