<?php

namespace App\Livewire;

use App\Models\Hero;
use App\Models\PublicPage;
use App\Models\Social;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class GuestHero extends Component
{

    public $image = '';

    public function render(): View
    {
        $hero = Hero::first();
        return view('livewire.public.guest-hero', [
            'hero' => Hero::first(),
            'publicHero' => PublicPage::where('hero', true)->first(),
            'social' => Social::first(),
        ]);
    }
}
