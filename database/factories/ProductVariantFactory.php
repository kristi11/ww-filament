<?php

namespace Database\Factories;

use App\Enums\Colors;
use App\Enums\OutfitSizes;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'color' => $this->faker->randomElement(Colors::class),
            'size' => $this->faker->randomElement(OutfitSizes::class),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
