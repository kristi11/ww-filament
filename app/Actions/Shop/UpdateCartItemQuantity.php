<?php

namespace App\Actions\Shop;

use App\Factories\CartFactory;

class UpdateCartItemQuantity
{
    /**
     * Increment the quantity of a cart item
     *
     * @param int $itemId The ID of the cart item
     * @return bool True if the operation was successful, false otherwise
     */
    public function increment(int $itemId): bool
    {
        $item = CartFactory::make()->items->find($itemId);
        if (!$item) {
            return false;
        }

        $item->increment('quantity');
        return true;
    }

    /**
     * Decrement the quantity of a cart item
     * Will not decrement below 1
     *
     * @param int $itemId The ID of the cart item
     * @return bool True if the operation was successful, false otherwise
     */
    public function decrement(int $itemId): bool
    {
        $item = CartFactory::make()->items->find($itemId);
        if (!$item || $item->quantity <= 1) {
            return false;
        }

        $item->decrement('quantity');
        return true;
    }
}
