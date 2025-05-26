<?php

namespace Database\Factories;

use App\Models\SectionColors;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SectionColorsFactory extends Factory
{
    protected $model = SectionColors::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'loginBackgroundColor' => 'bg-slate-50',
            'servicesBackgroundColor' => 'bg-slate-50',
            'hoursBackgroundColor' => 'bg-slate-50',
            'galleryBackgroundColor' => 'bg-white',
            'ctaBackgroundColor' => null,
            'footerBackgroundColor' => 'bg-white',
        ];
    }
}
