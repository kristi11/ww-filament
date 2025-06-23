<?php

namespace App\Livewire;

use App\Actions\Footer\GetFooterSocialsData;
use Livewire\Component;

class FooterSocials extends Component
{
    public bool $icons = false;

    public function mount(bool $icons = false)
    {
        $this->icons = $icons;
    }

    public function render(GetFooterSocialsData $getFooterSocialsData)
    {
        return view('livewire.footer-socials', $getFooterSocialsData->execute());
    }
}
