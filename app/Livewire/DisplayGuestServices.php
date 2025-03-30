<?php

namespace App\Livewire;

use App\Models\Flexibility;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

/**
 * Component for displaying services to guest users
 */
class DisplayGuestServices extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    /**
     * The number of services to display per page
     *
     * @var int
     */
    private const SERVICES_PER_PAGE = 3;

    /**
     * Render the component view
     */
    public function render(): View
    {
        return view('livewire.display-guest-services', [
            'services' => $this->getServices(),
            'flexible_pricing' => $this->hasFlexiblePricing(),
        ]);
    }

    /**
     * Redirect to the customer appointments page
     */
    public function bookService()
    {
        return redirect()->to('dashboard/customer-appointments');
    }

    /**
     * Get paginated services
     */
    private function getServices()
    {
        return Service::simplePaginate(self::SERVICES_PER_PAGE);
    }

    /**
     * Check if flexible pricing is enabled
     */
    private function hasFlexiblePricing(): ?Flexibility
    {
        return Flexibility::where('flexible_pricing', true)->first();
    }
}
