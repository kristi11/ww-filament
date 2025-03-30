<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class GuestLinks extends Component
{
    public function render(): View
    {
        return view('livewire.public.guest-links');
    }
}
