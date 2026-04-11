<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            ['name' => 'John Carter', 'email' => 'john@example.com', 'message' => 'I would like to discuss a Laravel portal for my training business.'],
            ['name' => 'Rebecca Lin', 'email' => 'rebecca@example.com', 'message' => 'Can you help us modernize our current admin dashboard and improve performance?'],
            ['name' => 'Samuel Obi', 'email' => 'samuel@example.com', 'message' => 'We need a case-study quality product site and internal reporting tools.'],
            ['name' => 'Nadia Fox', 'email' => 'nadia@example.com', 'message' => 'Interested in a discovery call for an EdTech MVP build.'],
            ['name' => 'Kelvin Drew', 'email' => 'kelvin@example.com', 'message' => 'Please share your timeline and approach for a CRM upgrade project.'],
        ];

        foreach ($messages as $row) {
            Contact::query()->updateOrCreate(
                ['email' => $row['email']],
                [
                    'name' => $row['name'],
                    'message' => $row['message'],
                ]
            );
        }
    }
}
