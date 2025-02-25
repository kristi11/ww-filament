<?php

/**
 * Component responsible for handling cart operations in the Laravel Livewire application.
 *
 * This class provides functionalities to manage shopping cart items, handle checkout
 * through Stripe, and manage customer navigation (e.g., registration, login, shop redirection).
 * It also allows for dynamic updates and rendering of cart attributes.
 *
 * Dependencies:
 * - `CreateStripeCheckoutSession`: Handles creating Stripe checkout sessions.
 * - `CartFactory`: Creates and populates the cart object.
 */

namespace App\Livewire;

use /**
 * This class is responsible for creating a Stripe Checkout Session
 * within the shop-related actions of the application.
 *
 * The class integrates with Stripe API to initiate and manage
 * a checkout session for processing transactions. It handles
 * business logic associated with preparing and ensuring a valid
 * Stripe session is created based on the provided request data.
 *
 * Key considerations:
 * - Ensures compatibility with MySQL database configurations.
 * - Utilizes Laravel's queue connection with a `sync` driver for immediate execution.
 * - Structured for usage within the Laravel framework (v10).
 *
 * Usage:
 * This action is designed to be called where checkout sessions are required
 * to be initiated for purchases in the application.
 *
 * Dependencies:
 * - Stripe API.
 * - Laravel's database and queue facilities.
 *
 * Methods:
 * - Implement the primary method to initialize and create a session.
 */
    App\Actions\Shop\CreateStripeCheckoutSession;
use /**
 * Class CartFactory
 *
 * This factory class is responsible for creating and managing instances of carts within the application.
 * It provides methods for initializing, configuring, or handling cart-related operations.
 *
 * @package App\Factories
 */
    App\Factories\CartFactory;
use /**
 * The Computed attribute is used in Livewire components to define
 * computed properties. Computed properties are automatically calculated
 * based on other component properties and are re-evaluated whenever
 * their dependent properties change. They are useful for encapsulating
 * logic that derives additional data from the existing component state.
 *
 * @package Livewire\Attributes
 */
    Livewire\Attributes\Computed;
use /**
 * The On attribute in Livewire is used to handle browser events
 * and bind them to methods or properties within a Livewire component.
 *
 * When the specified event occurs, the associated method in the
 * Livewire component is invoked automatically. This is helpful for
 * creating reactive components responsive to user interaction.
 *
 * @package Livewire\Attributes
 */
    Livewire\Attributes\On;
use /**
 * Class representing a Livewire component in a Laravel application.
 *
 * This class extends the base Livewire\Component class, enabling the use
 * of Livewire's reactive, single-page functionality within the Laravel framework.
 *
 * Features of this Livewire component include:
 * - Reactive properties for dynamic data updates without full-page reloads.
 * - Lifecycle hooks and methods to handle component behaviors.
 * - Support for emitting events and handling browser interactions.
 *
 * Note:
 * - Queue connection is configured to `sync`.
 * - The application uses `mysql` as the database connection.
 *
 * Laravel Version: 10.48.26.
 * Framework: Laravel
 * Database: MySQL
 */
    Livewire\Component;

/**
 * Represents the Cart component for managing cart actions and rendering.
 */
class Cart extends Component
{


    #[Computed]
    public function cart()
    {
        return CartFactory::make()->loadMissing(['items', 'items.product', 'items.variant']);
    }

    #[Computed]
    #[On('productDeletedFromCart')]
    public function items()
    {
        return $this->cart->items;
    }

    public function increment($itemId)
    {
        return $this->cart->items->find($itemId)?->increment('quantity');
    }
    public function decrement($itemId): void
    {
        $item = $this->cart->items->find($itemId);
        if ($item->quantity > 1){
            $item->decrement('quantity');
        }
    }

    public function checkout(CreateStripeCheckoutSession $checkoutSession)
    {
        return $checkoutSession->createFromCart($this->cart);
    }


    public function customerRegistration()
    {
        return redirect(url('dashboard/register'));
    }

    public function customerLogin()
    {
        return redirect(url('dashboard/login'));
    }

    public function shop()
    {
        return redirect(route('shop'));
    }

    public function delete($itemId): void
    {
        $this->cart->items()->where('id', $itemId)->delete();
        $this->dispatch('productDeletedFromCart');
    }

    public function renderAttributes($variant): array
    {
        $enumMappings = config('enums', []); // Retrieve mappings from config
        $output = [];

        foreach ($enumMappings as $key => $enumClass) {
            $value = $variant->$key ?? null; // Safely access value

            if ($value instanceof $enumClass) {
                $output[$key] = ucfirst($key) . ': ' . $value->getLabel();
            } elseif (!is_null($value)) {
                $output[$key] = ucfirst($key) . ': ' . $value;
            }
        }

        return $output;
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
