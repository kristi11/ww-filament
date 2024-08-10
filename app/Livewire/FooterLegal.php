<?php

namespace App\Livewire;

use App\Models\Privacy;
use App\Models\Terms;
use Livewire\Component;

class FooterLegal extends Component
{
    public function render()
    {
        return view('livewire.footer-legal',
        [
            'terms' => Terms::first()->visibility,
            'privacy' => Privacy::first()->visibility,
        ]);
    }
}
