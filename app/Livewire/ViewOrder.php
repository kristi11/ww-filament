<?php

/**
 * Class ViewOrder
 *
 * This Livewire component is responsible for displaying order details for an authenticated user.
 * It utilizes the Livewire framework to dynamically handle rendering and functionality within the
 * Laravel application. The class fetches the order details associated with the provided order ID
 * and ensures that the authenticated user has access to the specific order.
 *
 * Properties:
 * - $orderId: Stores the ID of the order to be displayed.
 *
 * Methods:
 * - mount($orderId): Initializes the component with the provided order ID.
 * - order(): Retrieves the order details for the authenticated user using the provided order ID.
 * - render(): Renders the associated Livewire view component.
 */

namespace App\Livewire;

use /**
 * @namespace Livewire\Attributes
 *
 * The `Computed` attribute in Livewire is used to denote a method or property
 * that should be computed dynamically and made available to the component.
 * Computed properties or methods are useful for deriving data without storing
 * it explicitly in the component's state.
 *
 * When using this attribute, Livewire automatically re-computes the value
 * whenever its dependencies change during the lifecycle of the component.
 * This approach promotes a cleaner and more efficient way of managing state
 * within the Livewire components.
 *
 * Usage of the `Computed` attribute requires careful management of property
 * dependencies to ensure accuracy and performance.
 */
Livewire\Attributes\Computed;
use /**
 * Class LivewireComponent
 *
 * This class represents a Livewire component in a Laravel application.
 * Livewire is a framework for building dynamic interfaces with Laravel.
 *
 * The application is built using Laravel version 10.48.26.
 * It uses a MySQL database as its storage backend and utilizes a queue system with a 'sync' connection.
 *
 * This component allows the development of user interfaces with real-time updates
 * and reactive properties, leveraging Livewire's features for maintaining state.
 */
Livewire\Component;

/**
 * A Livewire component for viewing an order.
 */
class ViewOrder extends Component
{
    public $orderId;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
    }

    #[Computed]
    public function order()
    {
        return auth()->user()->orders()->findOrFail($this->orderId);
    }

    public function render()
    {
        return view('livewire.view-order');
    }
}
