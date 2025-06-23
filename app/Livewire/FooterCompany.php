<?php

namespace App\Livewire;

use App\Actions\Footer\GetFooterCompanyData;
use Livewire\Component;

class FooterCompany extends Component
{
    public function render(GetFooterCompanyData $getFooterCompanyData)
    {
        return view('livewire.footer-company', $getFooterCompanyData->execute());
    }
}
