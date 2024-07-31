<?php

namespace App\Livewire;

use App\Models\Flexibility;
use App\Models\PublicPage;
use App\Models\Service;
use Illuminate\View\View;
use Livewire\Component;

class DisplayGuestServices extends Component
{
    public function bookService()
    {
        return redirect(url('dashboard/customer-appointments'));
    }

    public function render(): View
    {
        $flexiblePricing = Flexibility::where('flexible_pricing', true)->first();

        return view('livewire.display-guest-services',
            [
                'services' => Service::all(),
                'flexible_pricing' => $flexiblePricing,
                'guestServices' => PublicPage::where('services', true)->first(),
            ]);
    }
}
