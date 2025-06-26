<?php

namespace App\Actions\Shop;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetProductById
{
    /**
     * Get a product by its ID
     *
     * @param  int  $productId  The ID of the product to retrieve
     * @return Product The product if found
     *
     * @throws ModelNotFoundException If the product is not found
     */
    public function execute(int $productId): Product
    {
        return Product::findOrFail($productId);
    }
}
