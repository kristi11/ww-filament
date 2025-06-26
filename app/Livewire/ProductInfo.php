<?php

/**
 * This Livewire Component displays and manages interactions related to product details,
 * including the product's information and associated variant selection.
 *
 * @property Product $product The product instance being displayed.
 * @property mixed $variant The currently selected product variant ID.
 * @property array $rules Validation rules for the variant input.
 */

namespace App\Livewire;

use /**
 * Handles adding a product variant to the cart.
 *
 * This class performs the action of adding a specific product variant
 * into the shopping cart while ensuring the necessary validations
 * and operations are conducted.
 *
 * Dependencies:
 * - Laravel Framework v10.48.26
 * - MySQL database for persisting data
 * - Synchronous queue connection for task execution
 *
 * Responsibilities:
 * - Validate the provided product variant and cart inputs.
 * - Check inventory or stock levels for the requested product variant.
 * - Add the product variant to the appropriate cart session or record in the database.
 */
App\Actions\Shop\AddProductVariantToCart;
use App\Actions\Shop\GetProductById;
use /**
 * Class Product
 *
 * Represents the Product model in the application. This model interacts with the 'products' table in the database
 * using Laravel's Eloquent ORM. It provides functionality for handling product data, such as retrieving, creating,
 * updating, and deleting product records.
 *
 * - Laravel Framework Version: 10.48.26
 * - Database: MySQL
 * - Queue Connection: sync
 *
 * This model is a part of the application's Eloquent ORM layer and defines relationships, attributes, and additional
 * query scopes related to the products table.
 */
App\Models\Product;
use /**
 * The Casts\Attribute class provides a convenient way to define mutator and accessor logic for Eloquent model attributes in Laravel.
 *
 * It allows you to transform the value of a model attribute when retrieving or saving it to the database.
 *
 * This class is primarily utilized in the $casts property of an Eloquent model.
 *
 * Key Methods:
 * - `get()`: Define how the attribute value should be retrieved.
 * - `set()`: Define how the attribute value should be stored.
 *
 * Usage:
 * You can define custom attribute casting logic by returning an instance of `Attribute` in the model's cast definition.
 *
 * Benefits:
 * - Centralized data transformation logic.
 * - Simplifies attribute handling for special data formatting requirements.
 *
 * Example Scenarios:
 * - Hashing passwords before saving to the database.
 * - Automatically casting JSON data to arrays.
 * - Formatting dates or times when accessed.
 */
Illuminate\Database\Eloquent\Casts\Attribute;
use /**
 * This attribute is used to define computed properties
 * within Livewire components. Computed properties allow
 * for the creation of dynamic values derived from other data
 * properties or methods within the component.
 *
 * Usage of Livewire\Attributes\Computed ensures that
 * the property will be automatically evaluated whenever
 * its dependencies are updated.
 *
 * This attribute should only be applied to methods
 * within a Livewire component class.
 *
 * Key Notes:
 * - Computed properties are read-only.
 * - Their value is re-calculated when the dependencies change.
 *
 * Applies in scenarios where you need derived state
 * in a Livewire component based on the Livewire's
 * reactivity system.
 */
Livewire\Attributes\Computed;
use /**
 * Class Component
 *
 * This is a Livewire component used within a Laravel application.
 * The application is built on Laravel v10.48.26.
 * This component can be utilized for building dynamic user interfaces
 * with real-time DOM updates powered by Livewire.
 *
 * Dependencies:
 * - The application uses MySQL as its database backend.
 * - The queue connection is configured as "sync".
 *
 * Note: Define the logic and properties relevant to the specific UI functionality
 *       of this component in the implementation.
 */
Livewire\Component;
use /**
 * Class Currency
 *
 * Represents a currency with ISO 4217 currency code.
 */
Money\Currency;
use /**
 * The Money\Money class represents a monetary value with a specific currency.
 *
 * This class is used to perform arithmetic operations, comparisons, and
 * other functionalities with monetary amounts, ensuring precision and immutability.
 *
 * It is important to ensure that the currency of Money instances matches
 * when performing operations between them.
 *
 * Usage of this class typically involves the encapsulation of amounts as integers in the smallest unit
 * (e.g., cents for USD) to avoid floating-point precision issues.
 */
Money\Money;

/**
 * Represents a Livewire component for displaying and managing product information.
 */
class ProductInfo extends Component
{
    public Product $product;

    public $variant;

    public $rules = [
        'variant' => ['required', 'exists:App\Models\ProductVariant,id'],
    ];

    public function mount(): void
    {
        $this->variant = $this->product->variants()->value('id');
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: function (int $value) {
                return new Money($value, new Currency('USD'));
            }
        );
    }

    /**
     * Adds a product variant to the cart after validating the request and dispatches notifications.
     *
     * @param  AddProductVariantToCart  $cart  The cart instance to which the variant will be added.
     */
    public function addToCart(AddProductVariantToCart $cart): void
    {
        $this->validate();
        $cart->add(
            variantId: $this->variant
        );
        $this->dispatch('productAddedToCart');
        $this->dispatch('notify', 'Added to cart');

    }

    #[Computed]
    public function product(GetProductById $getProduct)
    {
        return $getProduct->execute($this->productId);
    }

    public function customerLogin()
    {
        return redirect(url('dashboard/login'));
    }

    public function render()
    {
        return view('livewire.product-info');
    }
}
