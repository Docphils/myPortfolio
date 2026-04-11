<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Projects Manager')]
class ProjectsManager extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';
    #[Url(as: 'status')]
    public string $status = 'all';
    #[Url(as: 'featured')]
    public string $featured = 'all';
    #[Url(as: 'sort')]
    public string $sort = 'latest';

    public function updating(string $property): void
    {
        if (in_array($property, ['search', 'status', 'featured', 'sort'], true)) {
            $this->resetPage();
        }
    }

    public function deleteProject(int $projectId): void
    {
        $project = Project::query()->findOrFail($projectId);
        foreach ($project->mediaItems() as $path) {
            Storage::disk('public')->delete($path);
        }

        $project->delete();
        session()->flash('success', 'Project deleted successfully.');
    }

    public function togglePublished(int $projectId): void
    {
        $project = Project::query()->findOrFail($projectId);
        $project->is_published = !$project->is_published;
        $project->published_at = $project->is_published ? now() : null;
        $project->save();

        session()->flash('success', 'Project publication status updated.');
    }

    public function toggleFeatured(int $projectId): void
    {
        $project = Project::query()->findOrFail($projectId);
        $project->is_featured = !$project->is_featured;
        $project->save();

        session()->flash('success', 'Project feature status updated.');
    }

    public function render()
    {
        $projects = Project::query()
            ->when($this->search !== '', function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->when($this->status === 'published', fn ($query) => $query->where('is_published', true))
            ->when($this->status === 'draft', fn ($query) => $query->where('is_published', false))
            ->when($this->featured === 'featured', fn ($query) => $query->where('is_featured', true))
            ->when($this->featured === 'normal', fn ($query) => $query->where('is_featured', false))
            ->when($this->sort === 'oldest', fn ($query) => $query->oldest())
            ->when($this->sort === 'title', fn ($query) => $query->orderBy('title'))
            ->when(!in_array($this->sort, ['oldest', 'title'], true), fn ($query) => $query->latest())
            ->paginate(9);

        return view('livewire.pages.admin.projects-manager', [
            'projects' => $projects,
        ]);
    }
}
