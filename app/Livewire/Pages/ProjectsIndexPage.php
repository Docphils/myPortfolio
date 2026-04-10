<?php

namespace App\Livewire\Pages;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;
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

    public function deleteProject(int $projectId): void
    {
        abort_unless(auth()->check(), 403);

        $project = Project::query()->findOrFail($projectId);
        foreach ($project->mediaItems() as $path) {
            Storage::disk('public')->delete($path);
        }

        $project->delete();
        session()->flash('success', 'Project deleted successfully.');
    }

    public function render()
    {
        $projects = Project::query()
            ->when($this->search !== '', function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->latest()
            ->paginate(9);

        return view('livewire.pages.projects-index-page', [
            'projects' => $projects,
        ])->layout('layouts.portfolio');
    }
}
