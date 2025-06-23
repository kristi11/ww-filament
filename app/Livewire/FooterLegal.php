<?php

namespace App\Livewire;

use App\Actions\Footer\GetFooterLegalData;
use Livewire\Component;

class FooterLegal extends Component
{
    public function render(GetFooterLegalData $getFooterLegalData)
    {
        return view('livewire.footer-legal', $getFooterLegalData->execute());
    }
}
