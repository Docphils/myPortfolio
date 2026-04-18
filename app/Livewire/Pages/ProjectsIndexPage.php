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

        $listItems = $projects->getCollection()
            ->values()
            ->map(static function (Project $project, int $index): array {
                return [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'url' => route('projects.show', $project),
                    'name' => $project->title,
                ];
            })->all();

        return view('livewire.pages.projects-index-page', [
            'projects' => $projects,
        ])->layout('layouts.portfolio', [
            'title' => 'Projects',
            'description' => 'Browse published web projects by DocPhils, including product builds, platform upgrades, and scalable application work.',
            'canonical' => route('projects.index'),
            'image' => 'images/project1.jpg',
            'type' => 'website',
            'structuredData' => [
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'CollectionPage',
                    'name' => 'Projects',
                    'url' => route('projects.index'),
                    'description' => 'Published projects and implementation work by DocPhils.',
                ],
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'ItemList',
                    'name' => 'Projects List',
                    'itemListElement' => $listItems,
                ],
            ],
            'robots' => $this->search !== ''
                ? 'noindex,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1'
                : 'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1',
        ]);
    }
}
