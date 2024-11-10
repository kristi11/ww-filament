<?php

namespace App\Livewire;

use App\Models\Hero;
use App\Models\PublicPage;
use Livewire\Component;

class GuestShopDisplay extends Component
{
    public function render()
    {
        return view('livewire.guest-shop-display', [
            'hero' => Hero::firstOrFail(),
            'shop' => PublicPage::where('shop', true)->first(),
        ]);
    }
}
