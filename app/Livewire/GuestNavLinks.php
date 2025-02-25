<?php

namespace App\Livewire;

use App\Models\Hero;
use App\Models\PublicPage;
use Illuminate\View\View;
use Livewire\Component;

class GuestNavLinks extends Component
{
    public function render(): View
    {
        return view('livewire.public.guest-nav-links', [
            'hero' => Hero::first(),
        ]);
    }
}
