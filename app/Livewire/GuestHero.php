<?php

namespace App\Livewire;

use App\Models\Hero;
use App\Models\PublicPage;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class GuestHero extends Component
{
    public $image = '';

    public function render(): View
    {
        $hero = Hero::firstOrFail();
        $image = $hero->getFirstMedia('default');
        return view('livewire.public.guest-hero', [
            'hero' => Hero::firstOrFail(),
            'image' => $image,
            'publicHero' => PublicPage::where('hero', true)->first(),
        ]);
    }
}
