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
            'mainQuote' => "Control your business",
            'secondaryQuote' => 'In one dashboard',
            'thirdQuote' => 'Check us out',
            'gradientType' => 'linear-gradient',
            'gradientDegree' => '90',
            'gradientDegreeStart' => '0',
            'gradientDegreeEnd' => '100',
            'gradientDegreeFirstColor' => '#0061ff',
            'gradientDegreeSecondColor' => '#60efff',
            'image' => null,
            'waves' => true,
        ];
    }
}
