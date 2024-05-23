<?php

namespace App\Livewire;

use App\Models\Social;
use Livewire\Component;

class FooterSocials extends Component
{
    public function render()
    {
        return view('livewire.footer-socials',
            [
                'social' => Social::first(),
            ]);
    }
}
