<?php
namespace App\Actions\Shop;

use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Cashier\Checkout;

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
                $descriptionItems[] = ucfirst($attribute) . ": {$value->getLabel()}";
            } elseif (!is_null($value)) {
                $descriptionItems[] = ucfirst($attribute) . ": $value";
            }
        }

        return $descriptionItems;
    }
}
