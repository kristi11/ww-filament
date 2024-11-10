<?php

namespace Database\Factories;

use App\Models\OrderItems;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderItemsFactory extends Factory
{
    protected $model = OrderItems::class;

    public function definition(): array
    {
        return [
            'order_id' => $this->faker->randomNumber(),
            'product_variant_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomNumber(),
            'quantity' => $this->faker->randomNumber(),
            'amount_discount' => $this->faker->randomNumber(),
            'amount_subtotal' => $this->faker->randomNumber(),
            'amount_tax' => $this->faker->randomNumber(),
            'amount_total' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
