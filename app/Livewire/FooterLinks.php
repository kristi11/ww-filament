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
            'faq' => cache()->remember('footer_links_faq', now()->addMinutes(60), function () {
                return FAQdata::first()->visibility;
            }),
            'help' => cache()->remember('footer_links_help', now()->addMinutes(60), function () {
                return Help::first()->visibility;
            }),
            'support' => cache()->remember('footer_links_support', now()->addMinutes(60), function () {
                return Support::first()->visibility;
            }),
        ]);
    }
}
