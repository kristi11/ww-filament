<?php

/**
 * This class represents a Livewire component for the cart navigation.
 * It listens for events related to adding or deleting products from the cart
 * and updates itself accordingly. It also provides a computed property
 * to calculate the total count of items in the cart.
 *
 * Dependencies:
 * - Uses the CartFactory to fetch cart data.
 * - Uses Livewire attributes and components for reactivity and rendering.
 *
 * Properties:
 * - $listeners: Array of events the component listens to, triggering a refresh of the component.
 *
 * Methods:
 * - count(): A computed property that aggregates the total quantity of items in the cart.
 * - render(): Defines the view file used to render this component.
 */

namespace App\Livewire;

use App\Actions\Shop\GetCartItemCount;
use /**
 * The Livewire\Attributes\Computed attribute is used to define computed properties
 * within a Livewire component. Computed properties are derived from other properties
 * or data and are automatically recalculated when their dependencies change.
 *
 * Usage of this attribute enhances reactivity and helps in avoiding manual recalculations
 * of dependent data in a Livewire component.
 *
 * This can be particularly useful for operations that need dynamic updates based on
 * the current state of the component or its inputs.
 *
 * @see https://laravel-livewire.com/docs for further details on Livewire and computed properties.
 */
Livewire\Attributes\Computed;
use /**
 * This class serves as a Livewire component in a Laravel application.
 * Livewire components are used for building dynamic interfaces using Laravel.
 */
Livewire\Component;

/**
 * Livewire component responsible for displaying and updating the navigation cart.
 */
class NavigationCart extends Component
{
    public $listeners = [
        'productAddedToCart' => '$refresh',
        'productDeletedFromCart' => '$refresh',
    ];

    #[Computed]
    public function count()
    {
        return app(GetCartItemCount::class)->execute();
    }

    public function render()
    {
        return view('livewire.navigation-cart');
    }
}
