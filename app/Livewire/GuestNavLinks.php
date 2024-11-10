<?php

namespace App\Livewire;

use App\Models\PublicPage;
use Illuminate\View\View;
use Livewire\Component;

class GuestNavLinks extends Component
{
    public function render(): View
    {
        return view('livewire.public.guest-nav-links', [
            'shop' => PublicPage::where('shop', true)->first(),
            'services' => PublicPage::where('services', true)->first(),
            'hours' => PublicPage::where('hours', true)->first(),
            'email' => PublicPage::where('email', true)->first(),
        ]);
    }
}
