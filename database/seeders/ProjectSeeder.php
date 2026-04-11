<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Learning Management Portal',
                'description' => 'A multi-role learning portal with enrollment, progress tracking, and reporting dashboards.',
                'link' => 'https://example.com/learning-portal',
            ],
            [
                'title' => 'Client CRM Workspace',
                'description' => 'A CRM experience for lead intake, assignment pipelines, and lifecycle communication.',
                'link' => 'https://example.com/crm-workspace',
            ],
            [
                'title' => 'Portfolio Commerce Site',
                'description' => 'A conversion-focused content and commerce platform with rapid content publishing.',
                'link' => 'https://example.com/portfolio-commerce',
            ],
            [
                'title' => 'Institution Request Hub',
                'description' => 'A request management system for institutions, approvals, and operational handoffs.',
                'link' => 'https://example.com/request-hub',
            ],
            [
                'title' => 'Instructor Scheduling System',
                'description' => 'A scheduling and assignment engine for tutor availability, matching, and reminders.',
                'link' => 'https://example.com/instructor-scheduling',
            ],
            [
                'title' => 'Service Catalog Platform',
                'description' => 'A searchable service catalog with SEO landing pages and configurable offers.',
                'link' => 'https://example.com/service-catalog',
            ],
        ];

        foreach ($projects as $index => $data) {
            $fileName = 'media/project-seed-'.($index + 1).'.svg';
            $this->createSvgPlaceholder($fileName, $data['title']);

            Project::query()->updateOrCreate(
                ['title' => $data['title']],
                [
                    'description' => $data['description'],
                    'media' => $fileName,
                    'link' => $data['link'],
                    'is_published' => true,
                    'is_featured' => $index < 5,
                    'published_at' => now()->subDays(30 - ($index * 3)),
                ]
            );
        }
    }

    private function createSvgPlaceholder(string $path, string $title): void
    {
        if (Storage::disk('public')->exists($path)) {
            return;
        }

        $safeTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1280" height="720" viewBox="0 0 1280 720">
  <defs>
    <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="#0f172a"/>
      <stop offset="100%" stop-color="#1d4ed8"/>
    </linearGradient>
  </defs>
  <rect width="1280" height="720" fill="url(#g)"/>
  <circle cx="1100" cy="120" r="180" fill="#22d3ee" opacity="0.18"/>
  <circle cx="220" cy="620" r="220" fill="#60a5fa" opacity="0.15"/>
  <text x="80" y="360" fill="#ffffff" font-family="Arial, sans-serif" font-size="56" font-weight="700">{$safeTitle}</text>
  <text x="80" y="430" fill="#bae6fd" font-family="Arial, sans-serif" font-size="28">Seed Placeholder Asset</text>
</svg>
SVG;

        Storage::disk('public')->put($path, $svg);
    }
}
