<?php

namespace App\Actions\Shop;

use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Database\Eloquent\Collection;

class CreateStripeCheckoutSession
{
    public function createFromCart(Cart $cart)
    {
        return  $cart->user
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
                            ]
                        ]
        );
    }

    private function formatCartItems(Collection $items)
    {
        return $items->loadMissing('product', 'variant')->map(function (CartItems $item) {
           return [
                'price_data' => [
                    'currency' => 'USD',
                    'unit_amount' => $item->product->price->getAmount(),
                    'product_data' => [
                        'name' => $item->product->name,
                        'description' => "Size: {$item->variant->size} - Color {$item->variant->color}",
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
}
