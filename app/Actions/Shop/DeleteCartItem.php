<?php

namespace App\Actions\Shop;

use App\Factories\CartFactory;

class DeleteCartItem
{
    /**
     * Delete a cart item by its ID
     *
     * @param  int  $itemId  The ID of the cart item to delete
     * @return bool True if the item was deleted, false otherwise
     */
    public function execute(int $itemId): bool
    {
        return CartFactory::make()->items()->where('id', $itemId)->delete() > 0;
    }
}
