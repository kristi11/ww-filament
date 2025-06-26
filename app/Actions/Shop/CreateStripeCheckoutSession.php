<?php

/**
 * Handles the creation of a Stripe Checkout Session based on the user's cart.
 */

namespace App\Actions\Shop;

use /**
 * The Cart model represents a shopping cart within the application.
 *
 * This model interacts with the 'carts' table in the MySQL database,
 * and it is responsible for handling operations related to a user's cart.
 *
 * Features:
 * - Provides access to cart item details.
 * - Calculates total cost, discounts, and other cart operations.
 * - Supports adding, updating, and removing items in the cart.
 *
 * Relationships:
 * Define relationships with related models, such as users or products, if applicable.
 *
 * Usage:
 * This model is utilized in providing shopping cart functionality
 * throughout the Laravel application.
 *
 * Queue Connection:
 * Please note that queue connection is set to 'sync' in this application.
 */
App\Models\Cart;
use /**
 * The CartItems model.
 *
 * Represents items in the user's cart.
 *
 * This model is associated with the 'cart_items' table in the database.
 *
 * Relationships:
 * - May have a relation with a Product model that represents the product associated with the cart item.
 * - May include a relation to a User model representing the owner of the cart.
 *
 * Special Notes:
 * - This model may handle functionalities such as adding, updating, and removing items from the cart.
 * - May include handling of quantity and price calculations based on the associated product.
 *
 * Properties:
 * - Table name is 'cart_items'.
 * - May include timestamps for tracking records.
 *
 * Usage:
 * - Interact with the database table 'cart_items' to manage shopping cart operations.
 * - Methods may include ways to calculate totals, validate stock, etc. against associated product inventory.
 *
 * Database Structure:
 * - Includes fields such as 'id', 'user_id', 'product_id', 'quantity', 'price', and timestamps.
 */
App\Models\CartItems;
use /**
 * Illuminate\Database\Eloquent\Collection
 *
 * Represents a collection of Eloquent models. This class provides a convenient
 * wrapper around an array of models with several helper methods for manipulating
 * and interacting with the associated Eloquent models.
 *
 * Features include:
 * - Extending Laravel's base Support Collection class.
 * - Providing methods specific to Eloquent model collections.
 * - Enabling batch operations on sets of models.
 * - Simplifying tasks such as eager loading and filtering of models.
 *
 * Commonly used when working with multiple Eloquent model records retrieved
 * from a query.
 *
 * @see https://laravel.com/docs/eloquent
 */
Illuminate\Database\Eloquent\Collection;
use /**
 * Class Checkout
 *
 * This class facilitates handling the checkout process in a Laravel application
 * integrated with Laravel Cashier for subscription billing and one-time payments.
 *
 * Laravel Cashier provides an easy interface for interacting with Stripe, and
 * this class typically includes methods and properties to manage the checkout
 * workflow.
 *
 * Key functionalities might include:
 * - Generating checkout sessions.
 * - Managing Stripe payment intents.
 * - Retrieving order or payment details.
 */
Laravel\Cashier\Checkout;

/**
 * Handles the creation of a Stripe Checkout session from a given cart.
 */
class CreateStripeCheckoutSession
{
    public function createFromCart(Cart $cart): Checkout
    {
        return $cart->user
            ->allowPromotionCodes()
            ->checkout(
                $this->formatCartItems($cart->items),
                [
                    'customer_update' => [
                        'shipping' => 'auto',
                    ],
                    'shipping_address_collection' => [
                        'allowed_countries' => ['US'],
                    ],
                    'success_url' => route('checkout-status').'?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('cart'),
                    'metadata' => [
                        'user_id' => $cart->user->id,
                        'cart_id' => $cart->id,
                    ],
                ]
            );
    }

    private function formatCartItems(Collection $items): array
    {
        return $items->loadMissing('product', 'variant')->map(function (CartItems $item) {
            $descriptionItems = $this->generateDescriptionItems($item);

            return [
                'price_data' => [
                    'currency' => 'USD',
                    'unit_amount' => $item->product->price * 100,
                    'product_data' => [
                        'name' => $item->product->name,
                        'description' => implode(' - ', $descriptionItems),
                        'metadata' => [
                            'product_id' => $item->product->id,
                            'product_variant_id' => $item->product_variant_id,
                        ],
                    ],
                ],
                'quantity' => $item->quantity,
            ];
        })->toArray();
    }

    private function generateDescriptionItems(CartItems $item): array
    {
        $enumMappings = config('enums', []); // Load the enum mappings with a default to avoid null
        $descriptionItems = [];

        foreach ($enumMappings as $attribute => $enumClass) {
            $value = $item->variant->$attribute;

            if ($value instanceof $enumClass) {
                $descriptionItems[] = ucfirst($attribute).": {$value->getLabel()}";
            } elseif (! is_null($value)) {
                $descriptionItems[] = ucfirst($attribute).": $value";
            }
        }

        return $descriptionItems;
    }
}
