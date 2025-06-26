<?php

namespace App\Actions\Shop;

use App\Factories\CartFactory;

class GetCartItemCount
{
    /**
     * Get the total count of items in the cart
     */
    public function execute(): int
    {
        return CartFactory::make()->items()->sum('quantity');
    }
}
