<?php

namespace App\Livewire;

use App\Models\BusinessHour;
use App\Models\Flexibility;
use App\Models\Hero;
use App\Models\PublicPage;
use App\Models\SectionColors;
use Illuminate\View\View;
use Livewire\Component;

class DisplayGuestBusinessHours extends Component
{
    public function render(): View
    {
        $alwaysOpen = Flexibility::where('always_open', true)->first();

        return view('livewire.display-guest-business-hours',
            [
                'hero' =>Hero::firstOrFail(),
                'hours' => BusinessHour::all(),
                'always_open' => $alwaysOpen,
                'guestHours' => PublicPage::where('hours', true)->first(),
                'background' => SectionColors::first(),
            ]);
    }
}
