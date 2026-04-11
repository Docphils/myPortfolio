<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::query()->updateOrCreate(
            ['id' => 1],
            [
                'content' => "I design and build robust web products with Laravel and Livewire.\n\nMy focus is delivering maintainable systems, clear UX, and measurable business outcomes. I especially enjoy working on EdTech and workflow-heavy platforms where reliability and clarity are non-negotiable.",
            ]
        );
    }
}
