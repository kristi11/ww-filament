<?php

namespace App\Livewire;

use AllowDynamicProperties;
use App\Filament\Customer\Resources\CustomerAppointmentResource;
use App\Filament\Resources\AppointmentResource;
use App\Models\Flexibility;
use App\Models\PublicPage;
use App\Models\SectionColors;
use App\Models\Service;
use Filament\Facades\Filament;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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
