<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Social;
use App\Models\User;

class SocialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Social::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'facebook' => $this->faker->userName(),
            'instagram' => $this->faker->userName(),
            'twitter' => $this->faker->userName(),
            'linkedin' => $this->faker->userName(),
        ];
    }
}
