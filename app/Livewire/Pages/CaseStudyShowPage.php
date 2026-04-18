<?php

namespace App\Livewire\Pages;

use App\Models\CaseStudy;
use Livewire\Component;

class CaseStudyShowPage extends Component
{
    public CaseStudy $caseStudy;

    public function mount(CaseStudy $caseStudy): void
    {
        abort_unless(
            $caseStudy->is_published && ($caseStudy->published_at === null || $caseStudy->published_at->isPast()),
            404
        );

        $this->caseStudy = $caseStudy;
    }

    public function render()
    {
        $coverImage = $this->caseStudy->cover_image
            ? asset('storage/' . $this->caseStudy->cover_image)
            : asset('images/project2.jpg');
        $description = trim((string) ($this->caseStudy->excerpt ?: $this->caseStudy->challenge ?: 'Published case study by DocPhils.'));
        $description = mb_substr($description, 0, 160);

        return view('livewire.pages.case-study-show-page')->layout('layouts.portfolio', [
            'title' => $this->caseStudy->title . ' Case Study',
            'description' => $description,
            'canonical' => route('case-studies.show', $this->caseStudy),
            'image' => $coverImage,
            'type' => 'article',
            'structuredData' => [
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'Article',
                    'headline' => $this->caseStudy->title,
                    'description' => $description,
                    'image' => $coverImage,
                    'datePublished' => optional($this->caseStudy->published_at)->toAtomString(),
                    'dateModified' => optional($this->caseStudy->updated_at)->toAtomString(),
                    'author' => [
                        '@type' => 'Person',
                        'name' => 'DocPhils',
                    ],
                    'mainEntityOfPage' => route('case-studies.show', $this->caseStudy),
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
                            'name' => 'Case Study',
                            'item' => route('case-studies.show', $this->caseStudy),
                        ],
                    ],
                ],
            ],
        ]);
    }
}
