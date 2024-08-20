<?php

namespace App\Livewire\Animation;

use App\Models\Hero;
use Livewire\Component;

class HeroSecondaryQuoteAnimation extends Component
{
    public function render()
    {
        return view('livewire.animation.hero-secondary-quote-animation',
        [
            'hero' => Hero::first(),
        ]);
    }
}
