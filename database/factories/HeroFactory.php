<?php

namespace Database\Factories;

use App\Models\Hero;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HeroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hero::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'mainQuote' => 'Your business needs',
            'secondaryQuote' => 'All in one place',
            'thirdQuote' => 'Check us out',
            'gradientDegree' => '90',
            'gradientDegreeStart' => '0',
            'gradientDegreeEnd' => '100',
            'gradientDegreeFirstColor' => '#B779FF',
            'gradientDegreeSecondColor' => '#8FF09E',
            'image' => null,
            'waves' => true,
        ];
    }
}
