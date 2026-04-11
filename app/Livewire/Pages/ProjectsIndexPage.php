<?php

namespace App\Livewire\Pages;

use App\Models\Project;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsIndexPage extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $projects = Project::query()
            ->when($this->search !== '', function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->published()
            ->latest('published_at')
            ->latest('id')
            ->paginate(9);

        return view('livewire.pages.projects-index-page', [
            'projects' => $projects,
        ])->layout('layouts.portfolio');
    }
}
