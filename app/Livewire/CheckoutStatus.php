<?php

/**
 * CheckoutStatus is a Livewire component providing functionality to handle and display
 * the checkout status of an order, with options to redirect users to relevant sections
 * such as appointments, gallery, and orders within a customer panel.
 *
 * This class makes use of Filament for handling customer panel URLs and utilizes
 * Laravel's auth system for retrieving order data associated with the authenticated user.
 *
 * Properties:
 * - $sessionId: The Stripe checkout session ID associated with the order.
 * - $order: The model instance of the order fetched based on the session ID.
 * - $customerPanelUrl: The URL for the customer panel, fetched via Filament.
 *
 * Methods:
 * - mount(): Fetches the session ID from the request, retrieves the associated order,
 *   and sets the customer panel URL.
 * - appointments(): Redirects the user to the customer appointments dashboard.
 * - gallery(): Redirects the user to the service images dashboard.
 * - orders(): Redirects the user to the orders dashboard.
 * - order(): A computed property to fetch the order based on the Stripe checkout session ID.
 * - render(): Returns the view for the Livewire component.
 *
 * Exceptions:
 * - ContainerExceptionInterface: Thrown when there is an issue with the container.
 * - NotFoundExceptionInterface: Thrown when a container entry is not found.
 */

namespace App\Livewire;

use /**
 * @property string $name The name of the application.
 * @property string $version The Laravel version of the application.
 * @property string $database The database connection being used by the application.
 * @property string $queueConnection The queue connection being used by the application.
 *
 * The application uses the MySQL database and operates with the sync queue connection.
 * This documentation provides an overview of the specified attributes relevant to the Laravel application context.
 *
 * @mixin \Illuminate\Foundation\Application
 * @mixin \Illuminate\Database\DatabaseManager
 *
 * @note Requires Laravel 10.48.26 or higher.
 * @note Using AllowDynamicProperties for dynamic property assignment.
 */
    AllowDynamicProperties;
use /**
 * Customer Appointment Resource handles all the operations
 * related to customer appointments within the Filament admin panel.
 *
 * This resource is responsible for managing customer appointment data,
 * including listing, creating, updating, and deleting appointments.
 *
 * The resource binds to the CustomerAppointment Model and utilizes
 * Filament for providing user-friendly interfaces and functionality.
 *
 * Laravel Version: 10.48.26
 * Database: MySQL
 * Queue Connection: Sync
 */
    App\Filament\Customer\Resources\CustomerAppointmentResource;
use /**
 * Facade for Filament.
 *
 * This facade provides static access to the Filament core features
 * and utilities within the Laravel application.
 *
 * @see \Filament\FilamentManager
 */
    Filament\Facades\Filament;
use /**
 * The Livewire\Attributes\Computed attribute is used to mark a method
 * in a Livewire component as a computed property. This means that the
 * method's return value is calculated dynamically and is available
 * as a public property in the Livewire component.
 *
 * Computed properties are automatically recalculated whenever the
 * dependent state changes. They are useful for deriving state or
 * combining information without needing to manage additional properties.
 *
 * This attribute can be applied to methods within a Livewire component
 * to enhance reactivity and simplify state management.
 */
    Livewire\Attributes\Computed;
use /**
 * Livewire\Component is a base class for creating Laravel Livewire components.
 * It allows building dynamic, reactive interfaces leveraging the power of Laravel's ecosystem.
 *
 * @property string $id Component's unique identifier managed by Livewire.
 * @property array $listeners Listens to specific events to trigger designated methods.
 *
 * Features:
 * - Supports reactive properties that auto-refresh on update.
 * - Enables server-side rendering with minimal front-end JavaScript.
 * - Incorporates Laravel features like validation, routing, and middleware.
 *
 * Application Information:
 * - Framework: Laravel, Version: 10.48.26
 * - Database: MySQL
 * - Queue Connection: sync
 *
 * @see https://laravel-livewire.com/ For detailed Livewire documentation.
 */
    Livewire\Component;
use /**
 * Interface ContainerExceptionInterface
 *
 * Represents a generic exception in a container.
 *
 * This interface is implemented to handle container-related exceptions
 * that do not belong to the entry-not-found category.
 * Implementations of this interface indicate errors that have occurred
 * while fetching or manipulating entries in the container.
 *
 * @package Psr\Container
 */
    Psr\Container\ContainerExceptionInterface;
use /**
 * Interface NotFoundExceptionInterface
 *
 * This interface represents an exception thrown when a container cannot find
 * a service or dependency by a specific identifier.
 *
 * @package Psr\Container
 */
    Psr\Container\NotFoundExceptionInterface;

/**
 * Class CheckoutStatus
 *
 * This Livewire component handles the checkout status of an order.
 * It utilizes dynamic properties and provides methods for navigating
 * to various sections of the customer panel.
 *
 * Attributes:
 * - $sessionId: The session ID retrieved from the request.
 * - $order: The order associated with the checkout session.
 * - $customerPanelUrl: The URL of the customer panel.
 *
 * Methods:
 * - mount(): Initializes component properties such as session ID, associated order, and customer panel URL.
 * - appointments(): Redirects to the customer appointments dashboard.
 * - gallery(): Redirects to the service images dashboard.
 * - orders(): Redirects to the orders dashboard.
 * - order(): Retrieves the first order matching the session ID for the authenticated user.
 * - render(): Renders the Livewire view for the component.
 *
 * Attributes:
 * - #[AllowDynamicProperties]: Permits dynamically defining properties on the class.
 * - #[Computed]: Marks the method as a computed property.
 */
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
