<?php

namespace Database\Factories;

use App\Models\About;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AboutFactory extends Factory
{
    protected $model = About::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'content' => $this->faker->word(),

            'user_id' => User::factory(),
        ];
    }
}
