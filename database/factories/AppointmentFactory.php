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
            'teamUser_id' => User::factory()->create()->id,
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'client_name' => $this->faker->word(),
            'client_email' => $this->faker->word(),
            'client_phone' => $this->faker->word(),
            'client_referer' => $this->faker->word(),
            'notes' => $this->faker->word(),
            'status' => $this->faker->word(),
        ];
    }

    /**
     * Define a state where the appointment has no team user assigned.
     */
    public function withoutTeamUser(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'teamUser_id' => null,
            ];
        });
    }
}
