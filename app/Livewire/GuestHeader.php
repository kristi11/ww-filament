<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\BusinessHour;
use App\Models\Hero;
use App\Models\PublicPage;
use App\Models\Social;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class GuestHeader extends Component
{
    public function render(): Factory|View|Application
    {
        return view('livewire.public.guest_header', [
            'hero' => Hero::firstOrFail(),
            'address' => Address::first(),
            'businessHours' => BusinessHour::all(),
            'social' => Social::first(),
        ]);
    }
}
