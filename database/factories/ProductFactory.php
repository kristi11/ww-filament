<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @method hasVariants()
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Cap', 'T-shirt', 'Blanket', 'Sweater']),
            'description' => 'Add promotion code 100OFF at checkout to get 100% off on any product, just for testing purposes. The products are test products that require a real bank account so the developers get an experience as close to a production environment as possible. If you add the above promo code you will not be charged anything',
            'price' => $this->faker->numberBetween(5_00, 45_00),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
