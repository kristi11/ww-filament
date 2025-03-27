<?php

namespace App\Livewire;

use App\Models\FAQdata;
use App\Models\Help;
use App\Models\Hero;
use App\Models\Support;
use Livewire\Component;

class FooterLinks extends Component
{
    public function render()
    {
        return view('livewire.footer-links', [
            'faq' => FAQdata::first()->visibility,
            'help' => Help::first()->visibility,
            'support' => Support::first()->visibility,
        ]);
    }
}
