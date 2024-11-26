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
            $descriptionItems = [];

            if (!is_null($item->variant->size)) {
                $descriptionItems[] = "Size: {$item->variant->size}";
            }

            if (!is_null($item->variant->color)) {
                $descriptionItems[] = "Color: {$item->variant->color->getLabel()}";
            }

            if (!is_null($item->variant->corecount)) {
                $descriptionItems[] = "Core count: {$item->variant->corecount->getLabel()}";
            }

            if (!is_null($item->variant->material)) {
                $descriptionItems[] = "Material: {$item->variant->material->getLabel()}";
            }

            if (!is_null($item->variant->enginevolume)) {
                $descriptionItems[] = "Engine volume: {$item->variant->enginevolume->getLabel()}";
            }

            if (!is_null($item->variant->dstorage)) {
                $descriptionItems[] = "Digital storage: {$item->variant->dstorage->getLabel()}";
            }

            if (!is_null($item->variant->graphiccardtype)) {
                $descriptionItems[] = "Graphic card type: {$item->variant->graphiccardtype->getLabel()}";
            }

            if (!is_null($item->variant->memorysize)) {
                $descriptionItems[] = "Memory size: {$item->variant->memorysize->getLabel()}";
            }

            if (!is_null($item->variant->processortype)) {
                $descriptionItems[] = "Processor type: {$item->variant->processortype->getLabel()}";
            }

            if (!is_null($item->variant->style)) {
                $descriptionItems[] = "Style: {$item->variant->style->getLabel()}";
            }

            if (!is_null($item->variant->volume)) {
                $descriptionItems[] = "Volume: {$item->variant->volume->getLabel()}";
            }

            // Convert array to string, with items separated by " - "
            $description = implode(" - ", $descriptionItems);
           return [
                'price_data' => [
                    'currency' => 'USD',
                    'unit_amount' => $item->product->price->getAmount(),
                    'product_data' => [
                        'name' => $item->product->name,
                        'description' => $description,
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
