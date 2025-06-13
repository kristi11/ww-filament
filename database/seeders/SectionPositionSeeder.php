<?php

namespace Database\Seeders;

use App\Models\SectionPosition;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first admin user or create one if none exists
        $user = User::first() ?? User::factory()->create();

        // Define the default sections and their positions
        $sections = [
            [
                'section_name' => 'display-socials',
                'position' => 1,
                'is_visible' => true,
                'user_id' => $user->id,
            ],
            [
                'section_name' => 'guest-login',
                'position' => 2,
                'is_visible' => true,
                'user_id' => $user->id,
            ],
            [
                'section_name' => 'display-guest-services',
                'position' => 3,
                'is_visible' => true,
                'user_id' => $user->id,
            ],
            [
                'section_name' => 'guest-shop-display',
                'position' => 4,
                'is_visible' => true,
                'user_id' => $user->id,
            ],
            [
                'section_name' => 'display-guest-business-hours',
                'position' => 5,
                'is_visible' => true,
                'user_id' => $user->id,
            ],
            [
                'section_name' => 'display-guest-gallery',
                'position' => 6,
                'is_visible' => true,
                'user_id' => $user->id,
            ],
        ];

        // Create the section positions
        foreach ($sections as $section) {
            SectionPosition::create($section);
        }
    }
}
