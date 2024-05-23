<?php

namespace Database\Factories;

use App\Models\Flexibility;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FlexibilityFactory extends Factory
{
    protected $model = Flexibility::class;

    public function definition(): array
    {
        return [
            'always_open' => $this->faker->boolean(),
            'flexible_pricing' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
