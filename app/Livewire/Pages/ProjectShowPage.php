<?php

namespace App\Livewire\Pages;

use App\Models\Project;
use Livewire\Component;

class ProjectShowPage extends Component
{
    public Project $project;

    public function mount(Project $project): void
    {
        abort_unless(
            $project->is_published && ($project->published_at === null || $project->published_at->isPast()),
            404
        );

        $this->project = $project;
    }

    public function render()
    {
        $images = $this->project->imageMedia();
        $primaryImage = count($images) > 0 ? asset('storage/' . $images[0]) : asset('images/project1.jpg');
        $description = trim((string) $this->project->description);
        $description = mb_substr($description, 0, 160);

        return view('livewire.pages.project-show-page')->layout('layouts.portfolio', [
            'title' => $this->project->title,
            'description' => $description !== '' ? $description : 'Project showcase by DocPhils.',
            'canonical' => route('projects.show', $this->project),
            'image' => $primaryImage,
            'type' => 'article',
            'structuredData' => [
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'CreativeWork',
                    'name' => $this->project->title,
                    'url' => route('projects.show', $this->project),
                    'description' => $description,
                    'image' => $primaryImage,
                    'author' => [
                        '@type' => 'Person',
                        'name' => 'DocPhils',
                    ],
                    'datePublished' => optional($this->project->published_at)->toAtomString(),
                    'dateModified' => optional($this->project->updated_at)->toAtomString(),
                ],
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => [
                        [
                            '@type' => 'ListItem',
                            'position' => 1,
                            'name' => 'Home',
                            'item' => route('welcome'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 2,
                            'name' => 'Projects',
                            'item' => route('projects.index'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 3,
                            'name' => $this->project->title,
                            'item' => route('projects.show', $this->project),
                        ],
                    ],
                ],
            ],
        ]);
    }
}
