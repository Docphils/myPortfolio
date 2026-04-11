<?php

namespace Database\Seeders;

use App\Models\CaseStudy;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CaseStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::query()->orderBy('id')->take(4)->get();

        foreach ($projects as $index => $project) {
            $title = $project->title.' Case Study';
            $slug = Str::slug($project->title).'-case-study';

            CaseStudy::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'project_id' => $project->id,
                    'title' => $title,
                    'excerpt' => 'How '.$project->title.' moved from concept to measurable impact.',
                    'challenge' => 'The team needed a scalable architecture and faster content operations without sacrificing performance.',
                    'solution' => 'We implemented Laravel 12 + Livewire workflows, clearer domain boundaries, and optimized rendering paths.',
                    'results' => 'Reduced operational friction, improved launch velocity, and delivered a more consistent user experience.',
                    'cover_image' => $project->imageMedia()[0] ?? null,
                    'project_url' => $project->link,
                    'stack' => ['Laravel 12', 'Livewire 4', 'Tailwind 4', 'MySQL'],
                    'sort_order' => $index,
                    'is_published' => true,
                    'published_at' => now()->subDays(14 - ($index * 2)),
                ]
            );
        }
    }
}
