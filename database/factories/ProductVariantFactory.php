<?php

namespace Database\Factories;

use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'product_id' => $this->faker->randomNumber(),
            'color' => $this->faker->randomElement(['Blue', 'Green', 'Yellow', 'Red']),
            'size' => $this->faker->randomElement(['S', 'M', 'L']),
        ];
    }
}
