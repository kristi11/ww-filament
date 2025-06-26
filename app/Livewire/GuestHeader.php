<?php

namespace App\Livewire;

use App\Models\Address;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class GuestHeader extends Component
{
    public function render(): Factory|View|Application
    {
        return view('livewire.public.guest_header', [
            'address' => cache()->remember('guest_header_address', now()->addMinutes(60), function () {
                return Address::first();
            }),
        ]);
    }
}
