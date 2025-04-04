<?php

/**
 * MobileNavigationCart is a Livewire Component responsible for
 * handling the behavior of a mobile navigation cart feature.
 *
 * This component listens for events related to cart updates,
 * such as adding or removing products, and refreshes itself
 * accordingly. It also provides a computed property to
 * calculate the total quantity of items in the cart.
 *
 * Dependencies:
 * - CartFactory: Used to access the cart's items for computation.
 * - Laravel queue connection: sync
 *
 * Listeners:
 * - productAddedToCart: Refreshes the component when a product is added.
 * - productDeletedFromCart: Refreshes the component when a product is deleted.
 */

namespace App\Livewire;

use /**
 * Factory class responsible for creating and managing Cart instances.
 *
 * This factory is part of the Laravel application and interacts with the MySQL database
 * to initialize or retrieve Cart data. It utilizes the synchronous queue connection for
 * any queued operations related to Cart objects.
 *
 * Usage of this class aligns with the Laravel v10.48.26 framework structure.
 *
 * @package App\Factories
 */
    App\Factories\CartFactory;
use /**
 * The Computed attribute is used in Livewire to define computed
 * properties for a Livewire component. Computed properties are
 * dynamic and automatically recomputed whenever their dependencies
 * change. These properties enhance reactivity and reduce the need
 * for explicit event handling or state updates in components.
 *
 * Applying this attribute to a method within a Livewire component
 * ensures the method is treated as a computed property and can be
 * accessed as a public property on the component.
 *
 * @category Livewire
 * @package  Livewire\Attributes
 */
    Livewire\Attributes\Computed;
use /**
 * This class represents a Livewire component in the Laravel application.
 *
 * Livewire components integrate seamlessly into Laravel to provide
 * reactive, dynamic functionality in the frontend without requiring
 * full page reloads.
 *
 * The Laravel application is built on version 10.48.26 and uses MySQL
 * as its database backend. The queue system operates with a `sync`
 * connection.
 *
 * Extend this class to implement a specific Livewire component for
 * managing frontend interactivity.
 *
 * Key Points:
 * - Build dynamic interfaces with server-side rendered components.
 * - State management between the frontend and backend via Livewire.
 * - Seamless integration in Laravel's ecosystem.
 *
 * Requirements:
 * - Ensure proper installation and configuration of Livewire in your application.
 * - Define component properties, methods, and lifecycle hooks as needed.
 *
 * @package Laravel
 */
    Livewire\Component;

/**
 * This class represents a Livewire component for a mobile navigation cart.
 * It listens for specific events to refresh its state and provides a computed property
 * to calculate the total quantity of items in the cart.
 */
class MobileNavigationCart extends Component
{
    public $listeners = [
        'productAddedToCart' => '$refresh',
        'productDeletedFromCart' => '$refresh'
    ];

    #[Computed]
    public function count()
    {
        return CartFactory::make()->items()->sum('quantity');
    }
    public function render()
    {
        return view('livewire.mobile-navigation-cart');
    }
}
