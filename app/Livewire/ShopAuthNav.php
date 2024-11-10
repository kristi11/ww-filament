<?php

namespace App\Livewire;

use AllowDynamicProperties;
use App\Filament\Resources\ProductResource;
use App\Providers\Filament\CustomerPanelProvider;
use Filament\Facades\Filament;
use Livewire\Component;

#[AllowDynamicProperties] class ShopAuthNav extends Component
{
    public $customerPanelUrl;
    public function mount()
    {
        $this->customerPanelUrl = Filament::getPanel('customer')->getUrl();
    }
    public function render()
    {
        return view('livewire.shop-auth-nav');
    }
}
