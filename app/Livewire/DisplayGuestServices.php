<?php

namespace App\Livewire;

use App\Models\Flexibility;
use App\Models\PublicPage;
use App\Models\SectionColors;
use App\Models\Service;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class DisplayGuestServices extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    public function bookService()
    {
        return redirect(url('dashboard/customer-appointments'));
    }

    public function render(): View
    {
        $flexiblePricing = Flexibility::where('flexible_pricing', true)->first();

        return view('livewire.display-guest-services',
            [
                'services' => Service::simplePaginate(3),
                'flexible_pricing' => $flexiblePricing,
                'guestServices' => PublicPage::where('services', true)->first(),
                'background' => SectionColors::first(),
            ]);
    }
}
