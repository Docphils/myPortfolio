<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            [
                'quote' => 'The platform launch was smooth and we saw immediate improvement in user engagement.',
                'author_name' => 'Amina Yusuf',
                'author_role' => 'Product Lead',
                'company' => 'LearnGrid',
                'rating' => 5,
            ],
            [
                'quote' => 'He translated our idea into a reliable product and communicated every step clearly.',
                'author_name' => 'David Cole',
                'author_role' => 'Founder',
                'company' => 'OpsMarket',
                'rating' => 5,
            ],
            [
                'quote' => 'Excellent code quality and delivery discipline. We now ship features with confidence.',
                'author_name' => 'Tolu Ade',
                'author_role' => 'Engineering Manager',
                'company' => 'TutorFlow',
                'rating' => 5,
            ],
            [
                'quote' => 'A dependable collaborator who balances speed, architecture, and real business needs.',
                'author_name' => 'Grace Newton',
                'author_role' => 'Operations Director',
                'company' => 'BrightPath',
                'rating' => 4,
            ],
        ];

        foreach ($rows as $index => $row) {
            Testimonial::query()->updateOrCreate(
                ['author_name' => $row['author_name'], 'company' => $row['company']],
                [
                    'quote' => $row['quote'],
                    'author_role' => $row['author_role'],
                    'rating' => $row['rating'],
                    'sort_order' => $index,
                    'is_featured' => true,
                    'is_published' => true,
                    'published_at' => now()->subDays(7 - $index),
                ]
            );
        }
    }
}
