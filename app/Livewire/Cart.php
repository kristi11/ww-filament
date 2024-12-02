<?php

namespace App\Livewire;

use App\Actions\Shop\CreateStripeCheckoutSession;
use App\Enums\Weight;
use App\Factories\CartFactory;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{


    #[Computed]
    public function cart()
    {
        return CartFactory::make()->loadMissing(['items', 'items.product', 'items.variant']);
    }

    #[Computed]
    #[On('productDeletedFromCart')]
    public function items()
    {
        return $this->cart->items;
    }

    public function increment($itemId)
    {
        return $this->cart->items->find($itemId)?->increment('quantity');
    }
    public function decrement($itemId): void
    {
        $item = $this->cart->items->find($itemId);
        if ($item->quantity > 1){
            $item->decrement('quantity');
        }
    }

    public function checkout(CreateStripeCheckoutSession $checkoutSession)
    {
        return $checkoutSession->createFromCart($this->cart);
    }


    public function customerRegistration()
    {
        return redirect(url('dashboard/register'));
    }

    public function customerLogin()
    {
        return redirect(url('dashboard/login'));
    }

    public function shop()
    {
        return redirect(route('shop'));
    }

    public function delete($itemId): void
    {
        $this->cart->items()->where('id', $itemId)->delete();
        $this->dispatch('productDeletedFromCart');
    }

    public function renderAttributes($variant): array
    {
        $attributes = [
            'size' => \App\Enums\OutfitSizes::class,
            'color' => \App\Enums\Colors::class,
            'corecount' => \App\Enums\CoreCount::class,
            'dstorage' => \App\Enums\DStorage::class,
            'enginevolume' => \App\Enums\EngineVolume::class,
            'graphiccardtype' => \App\Enums\GraphicCardType::class,
            'material' => \App\Enums\Material::class,
            'memorysize' => \App\Enums\MemorySize::class,
            'processortype' => \App\Enums\ProcessorType::class,
            'style' => \App\Enums\Style::class,
            'volume' => \App\Enums\Volume::class,
            'pattern' => \App\Enums\Patterns::class,
            'weight' => \App\Enums\Weight::class,
            'length' => \App\Enums\Length::class,
            'finish' => \App\Enums\Finish::class,
            'gender' => \App\Enums\Gender::class,
        ];

        $output = [];

        foreach ($attributes as $key => $enumClass) {
            $value = $variant->$key ?? null;
            if ($value instanceof $enumClass) {
                $output[$key] = ucfirst($key) . ': ' . $value->getLabel();
            } elseif (!is_null($value)) {
                $output[$key] = ucfirst($key) . ': ' . $value;
            }
        }

        return $output;
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
