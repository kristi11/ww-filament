<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'message' => $this->faker->paragraph(),
            'read' => $this->faker->boolean(),
            'status' => $this->faker->randomElement(['new', 'in_progress', 'completed']),
            'has_new_reply' => $this->faker->boolean(),
        ];
    }
}
