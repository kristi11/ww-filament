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
        return view('livewire.display-guest-business-hours', [
            'hours' => $this->getBusinessHours(),
            'always_open' => $this->getAlwaysOpenStatus(),
        ]);
    }

    /**
     * Get business hours data
     *
     * @return BusinessHour
     */
    private function getBusinessHours()
    {
        return cache()->remember('business_hours', now()->addMinutes(60), function () {
            return BusinessHour::select(['day', 'open', 'close', 'status'])->get();
        });
    }

    /**
     * Get the always open status from Flexibility settings
     *
     * @return Flexibility|null
     */
    private function getAlwaysOpenStatus()
    {
        return cache()->remember('always_open_status', now()->addMinutes(60), function () {
            return Flexibility::where('always_open', true)->first();
        });
    }
}
