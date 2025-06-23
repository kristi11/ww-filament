<?php

namespace App\Livewire;

use App\Actions\Footer\GetFooterData;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class GuestFooter extends Component
{
    public function render(GetFooterData $getFooterData): View
    {
        $footerData = $getFooterData->execute();

        return view('livewire.public.guest-footer', $footerData);
    }
}
