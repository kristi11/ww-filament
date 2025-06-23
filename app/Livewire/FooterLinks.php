<?php

namespace App\Livewire;

use App\Actions\Footer\GetFooterLinksData;
use Livewire\Component;

class FooterLinks extends Component
{
    public function render(GetFooterLinksData $getFooterLinksData)
    {
        return view('livewire.footer-links', $getFooterLinksData->execute());
    }
}
