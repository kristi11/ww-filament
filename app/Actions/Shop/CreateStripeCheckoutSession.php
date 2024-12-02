<?php
namespace App\Actions\Shop;

use App\Enums\Age;
use App\Enums\Colors;
use App\Enums\CoreCount;
use App\Enums\DStorage;
use App\Enums\EngineVolume;
use App\Enums\Finish;
use App\Enums\Gender;
use App\Enums\GraphicCardType;
use App\Enums\Length;
use App\Enums\Material;
use App\Enums\MemorySize;
use App\Enums\OutfitSizes;
use App\Enums\Patterns;
use App\Enums\ProcessorType;
use App\Enums\Style;
use App\Enums\Volume;
use App\Enums\Weight;
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
        $attributes = [
            'size' => OutfitSizes::class,
            'color' => Colors::class,
            'corecount' => CoreCount::class,
            'material' => Material::class,
            'enginevolume' => EngineVolume::class,
            'dstorage' => DStorage::class,
            'graphiccardtype' => GraphicCardType::class,
            'memorysize' => MemorySize::class,
            'processortype' => ProcessorType::class,
            'style' => Style::class,
            'volume' => Volume::class,
            'age' => Age::class,
            'pattern' => Patterns::class,
            'weight' => Weight::class,
            'length' => Length::class,
            'finish' => Finish::class,
            'gender' => Gender::class,
        ];

        $descriptionItems = [];

        foreach ($attributes as $attribute => $enumClass) {
            $value = $item->variant->$attribute;

            if ($value instanceof $enumClass) {
                $descriptionItems[] = ucfirst($attribute).": {$value->getLabel()}";
            } elseif (!is_null($value)) {
                $descriptionItems[] = ucfirst($attribute).": $value";
            }
        }

        return $descriptionItems;
    }
}
