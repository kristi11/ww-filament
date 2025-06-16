<?php

namespace App\Livewire;

use App\Models\Hero;
use App\Models\Privacy;
use App\Models\Terms;
use Livewire\Component;

class FooterLegal extends Component
{
    public function render()
    {
        return view('livewire.footer-legal',
        [
            'terms' => cache()->remember('footer_legal_terms', now()->addMinutes(60), function () {
                return Terms::first()->visibility;
            }),
            'privacy' => cache()->remember('footer_legal_privacy', now()->addMinutes(60), function () {
                return Privacy::first()->visibility;
            }),
        ]);
    }
}
