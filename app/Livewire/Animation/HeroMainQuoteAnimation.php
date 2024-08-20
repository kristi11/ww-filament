<?php

namespace App\Livewire\Animation;

use App\Models\Hero;
use Livewire\Component;

class HeroMainQuoteAnimation extends Component
{
    public function render()
    {
        return view('livewire.animation.hero-main-quote-animation',
        [
            'hero' => Hero::first()
        ]);
    }
}
