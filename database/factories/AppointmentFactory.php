<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Appointment;
use App\Models\User;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'service_id' => $this->faker->randomNumber(),
            'teamUser_id' => $this->faker->randomNumber(),
            'date' => $this->faker->word(),
            'time' => $this->faker->word(),
            'client_name' => $this->faker->word(),
            'client_email' => $this->faker->word(),
            'client_phone' => $this->faker->word(),
            'client_referer' => $this->faker->word(),
            'notes' => $this->faker->word(),
            'status' => $this->faker->word(),
        ];
    }
}
