<?php

namespace App\Livewire;

use App\Models\Hero;
use App\Models\Social;
use Livewire\Component;

class FooterSocials extends Component
{
    public bool $icons = false;

    public function mount(bool $icons = false)
    {
        $this->icons = $icons;
    }

    public function render()
    {
        return view('livewire.footer-socials');
    }
}
