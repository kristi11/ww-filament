<?php

namespace App\Livewire;

use AllowDynamicProperties;
use App\Filament\Customer\Resources\CustomerAppointmentResource;
use Filament\Facades\Filament;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

#[AllowDynamicProperties] class CheckoutStatus extends Component
{
    public $sessionId;
    public $order;
    public $customerPanelUrl;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function mount(): void
    {
        $this->sessionId = request()->get('session_id');
        $this->order = $this->order();
        $this->customerPanelUrl = Filament::getPanel('customer')->getUrl();
    }

    public function appointments()
    {
        return redirect('dashboard/customer-appointments');
    }

    public function gallery()
    {
        return redirect('dashboard/service-images');
    }

    public function orders()
    {
        return redirect('dashboard/orders');
    }

    #[Computed]
    public function order()
    {
        return auth()->user()->orders()->where('stripe_checkout_session_id', $this->sessionId)->first();
    }
    public function render()
    {
        return view('livewire.checkout-status');
    }
}
