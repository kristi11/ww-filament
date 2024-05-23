<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BusinessHour;
use App\Models\User;

class BusinessHourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BusinessHour::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $status = $this->faker->boolean;

        return [
            'user_id' => User::factory(),
            'day' => $this->faker->unique()->dayOfWeek(),
            'open' => $status ? $this->faker->time() : null,
            'close' => $status ? $this->faker->time() : null,
            'status' => $status,
        ];
    }
}
