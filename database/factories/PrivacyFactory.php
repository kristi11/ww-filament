<?php

namespace Database\Factories;

use App\Models\Privacy;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PrivacyFactory extends Factory
{
    protected $model = Privacy::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'content' => 'Relevant information should be added here',

            'user_id' => User::factory(),
        ];
    }
}
