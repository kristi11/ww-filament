<?php

namespace App\Livewire;

use App\Models\PublicPage;
use Livewire\Component;

class FullScreenImageNav extends Component
{
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.public.full-screen-image-nav',
        [
            'shop' => PublicPage::where('shop', true)->first(),
            'services' => PublicPage::where('services', true)->first(),
            'hours' => PublicPage::where('hours', true)->first(),
            'email' => PublicPage::where('email', true)->first(),
        ]);
    }
}
