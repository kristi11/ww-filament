<?php

namespace App\Livewire;

use App\Actions\Shop\CreateStripeCheckoutSession;
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
    public function render()
    {
        return view('livewire.cart');
    }
}
