<?php

namespace Database\Factories;

use App\Models\PublicPage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PublicPageFactory extends Factory
{
    protected $model = PublicPage::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'hero' => $this->faker->boolean(),
            'credentials' => $this->faker->boolean(),
            'services' => $this->faker->boolean(),
            'hours' => $this->faker->boolean(),
            'gallery' => $this->faker->boolean(),
            'email' => $this->faker->unique()->safeEmail(),
            'footer' => $this->faker->boolean(),
        ];
    }
}
