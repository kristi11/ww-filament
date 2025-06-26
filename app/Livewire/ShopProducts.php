<?php

/**
 * Class ShopProducts
 *
 * This class represents a Livewire component responsible for handling and displaying a paginated list of products
 * in the shop. It utilizes search functionality based on user-provided keywords.
 *
 * The component uses Livewire's WithPagination trait for pagination functionality and
 * integrates URL-based state management for the keyword query parameter.
 */

namespace App\Livewire;

use /**
 * Model representing the Product entity in the application.
 *
 * This model interacts with the 'products' table in the MySQL database.
 * It is part of the Laravel application and provides functionality
 * for managing products in the system.
 *
 * Key features and functionality of this model:
 * - Interacts with the 'products' table in the database.
 * - Utilizes Eloquent ORM for database operations.
 * - Supports relationships, scopes, and attributes as defined in the model.
 *
 * Queue connection used in the application is 'sync', ensuring immediate processing.
 * The application uses Laravel v10.48.26 with a MySQL database backend.
 *
 * Application Name: Laravel
 */
App\Models\Product;
use /**
 * The Computed attribute is part of the Livewire framework for Laravel.
 *
 * It is used to annotate methods that should be treated as computed properties in Livewire components.
 * Computed properties are methods whose return values are cached and only recalculated when other referenced properties are updated.
 *
 * Usage of this attribute minimizes boilerplate and improves performance by avoiding unnecessary recalculations.
 *
 * This attribute should be applied to a public method within a Livewire component.
 *
 * @see https://laravel-livewire.com/docs/2.x/computed-properties
 */
Livewire\Attributes\Computed;
use /**
 * Represents a Livewire URL attribute.
 *
 * The `Url` attribute is used to manage Livewire component URL bindings in Laravel applications.
 */
Livewire\Attributes\Url;
use /**
 * A Livewire component for use within a Laravel application.
 *
 * This class represents a dynamic frontend component in a Laravel application
 * using the Livewire library. Livewire allows the creation of interactive
 * interfaces without leaving the Laravel ecosystem, enabling robust
 * server-driven UI development.
 *
 * Features:
 * - Facilitates server-side rendering with seamless reactivity.
 * - Integrates easily with the Laravel framework.
 * - Implements lifecycle hooks for real-time interaction.
 * - Automatically updates the frontend based on the backend state.
 *
 * Requirements:
 * - Laravel version: 10.48.26
 * - Database: MySQL
 * - Queue connection: Synchronous mode
 *
 * Use this as a base for creating responsive, dynamic components that interact
 * with backend logic while maintaining a streamlined development approach. This
 * component adheres to the structure and conventions of Livewire components.
 */
Livewire\Component;/**
 * The WithoutUrlPagination trait can be used in Livewire components to disable
 * URL-based pagination. By default, when using pagination in Livewire, the
 * current page is appended to the URL. This behavior can be disabled by
 * including this trait in a Livewire component, thereby keeping the pagination
 * state within the component itself and not reflecting it in the URL.
 *
 * This is particularly useful in scenarios where URL state management is not
 * desired for paginated data or when avoiding potential conflicts between URL
 * parameters and component logic.
 *
 * When this trait is applied, pagination behavior will remain internal to the
 * Livewire component, and will not interact with the browser's address bar or
 * URL history.
 */

use /**
 * Trait WithPagination
 *
 * This trait is used for enabling pagination within Livewire components in a Laravel application.
 * It automatically handles the query string updates for pagination and integrates seamlessly
 * with Laravel's pagination tools. Using this trait, developers can manage paginated data
 * directly in Livewire components without additional wiring.
 *
 * Features:
 * - Binds pagination state to the Livewire component.
 * - Automatically appends the current page to the query string.
 * - Leverages Laravel's paginator for database query pagination.
 *
 * Requirements:
 * - The Laravel application should have pagination enabled.
 * - The Livewire component using this trait must be designed to work with paginated data.
 */
Livewire\WithPagination;

/**
 * Handles product display functionality within the shop, including pagination
 * and filtering based on keywords.
 */
class ShopProducts extends Component
{
    use WithPagination;

    #[Url]
    public $keywords;

    #[Computed]
    public function product()
    {
        return Product::query()
            ->latest()
            ->when($this->keywords, fn ($query) => $query->where('name', 'like', '%'.$this->keywords.'%'))
            ->Paginate(6);
    }

    public function render()
    {
        return view('livewire.shop-products');
    }
}
