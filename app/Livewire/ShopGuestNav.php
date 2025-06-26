<?php

namespace App\Livewire;

use AllowDynamicProperties;
use Filament\Facades\Filament;
use Livewire\Component;

#[AllowDynamicProperties] class ShopGuestNav extends Component
{
    public $customerPanelUrl;

    public function mount()
    {
        $this->customerPanelUrl = Filament::getPanel('customer')->getUrl();
    }

    public function render()
    {
        return view('livewire.shop-guest-nav');
    }
}
