<?php

namespace Database\Factories;

use App\Models\PublicPage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PublicPageFactory extends Factory
{
    protected $model = PublicPage::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'hero' => true,
            'credentials' => true,
            'services' => true,
            'shop' => true,
            'hours' => true,
            'gallery' => true,
            'email' => true,
            'footer' => true,
        ];
    }
}
