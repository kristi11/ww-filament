<?php

namespace App\Livewire;

use App\Actions\Services\CheckFlexiblePricing;
use App\Actions\Services\GetPaginatedServices;
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
    public function render(GetPaginatedServices $getServices, CheckFlexiblePricing $checkPricing): View
    {
        $currentPage = request()->query('page', 1);

        return view('livewire.display-guest-services', [
            'services' => $getServices->execute(self::SERVICES_PER_PAGE, $currentPage),
            'flexible_pricing' => $checkPricing->execute(),
        ]);
    }

    /**
     * Redirect to the customer appointments page
     */
    public function bookService()
    {
        return redirect()->to('dashboard/customer-appointments');
    }
}
