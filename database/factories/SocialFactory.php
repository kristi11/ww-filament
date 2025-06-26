<?php

namespace Database\Factories;

use App\Models\Social;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'facebook' => 'kristi.tanellari1',
            'instagram' => 'kristitanellari',
            'twitter' => 'Tanellarikristi',
            'linkedin' => 'kristi-tanellari',
        ];
    }
}
