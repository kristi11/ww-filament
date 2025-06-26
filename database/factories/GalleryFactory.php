<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'service_id' => Service::factory(),
            'description' => $this->faker->text(),
            'image' => $this->faker->text(),
        ];
    }
}
