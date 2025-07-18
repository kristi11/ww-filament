<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => 'Sample service name',
            'description' => 'Service description goes here. The estimated service completion times, business hours and the pricing are just placeholders to demonstrate what the service model and business hours look like.',
            'price' => $this->faker->numberBetween(30, 300),
            'estimated_hours' => $this->faker->numberBetween(1, 12),
            'estimated_minutes' => $this->faker->numberBetween(0, 59),
            'extra_description' => $this->faker->realText(),
        ];
    }
}
