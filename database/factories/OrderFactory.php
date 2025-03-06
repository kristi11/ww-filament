<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'stripe_checkout_session_id' => $this->faker->word(),
            'amount_shipping' => $this->faker->randomNumber(),
            'amount_discount' => $this->faker->randomNumber(),
            'amount_tax' => $this->faker->randomNumber(),
            'amount_subtotal' => $this->faker->randomNumber(),
            'amount_total' => $this->faker->randomNumber(),
            'billing_address' => $this->faker->address(),
            'shipping_address' => $this->faker->address(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
