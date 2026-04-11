<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'philip@mephed.ng'],
            [
                'name' => 'Philip Nwachukwu',
                'email_verified_at' => now(),
                'password' => Hash::make('Docphils6416@'),
            ]
        );

        //User::factory(4)->create();
    }
}
