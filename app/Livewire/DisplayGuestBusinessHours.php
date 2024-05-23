<?php

namespace App\Livewire;

use App\Models\BusinessHour;
use App\Models\Flexibility;
use Illuminate\View\View;
use Livewire\Component;

class DisplayGuestBusinessHours extends Component
{
    public function render(): View
    {
        $alwaysOpen = Flexibility::where('always_open', true)->first();

        return view('livewire.display-guest-business-hours',
            [
                'hours' => BusinessHour::all(),
                'always_open' => $alwaysOpen,
            ]);
    }
}
