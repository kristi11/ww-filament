<?php

/**
 * Action class responsible for migrating a session cart to a user cart.
 */

namespace App\Actions\Shop;

use /**
 * The Cart model represents the shopping cart used in the application.
 *
 * This model interacts with the `carts` table in the MySQL database
 * and handles operations related to items in the cart and their quantities.
 *
 * Laravel Version: 10.48.26
 *
 * @database-table carts
 * @queue-connection sync
 */
    App\Models\Cart;

/**
 *
 */
class MigrateSessionCart
{
    public function migrate(Cart $sessionCart, Cart $userCart): void
    {
        $sessionCart->items->each(fn($item) => (new AddProductVariantToCart())->add(
            variantId: $item->product_variant_id,
            quantity: $item->quantity,
            cart: $userCart
        ));

        $sessionCart->items()->delete();
        $sessionCart->delete();
    }
}
