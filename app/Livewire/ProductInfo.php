<?php

namespace App\Livewire;

use App\Actions\Shop\AddProductVariantToCart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Money\Currency;
use Money\Money;


class ProductInfo extends Component
{
    public Product $product;
    public $variant;
    public $rules = [
        'variant' => ['required', 'exists:App\Models\ProductVariant,id'],
    ];
    public function mount(): void
    {
        $this->variant = $this->product->variants()->value('id');
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: function (int $value) {
                return new Money($value, new Currency('USD'));
            }
        );
    }
    /**
     * Adds a product variant to the cart after validating the request and dispatches notifications.
     *
     * @param  AddProductVariantToCart  $cart  The cart instance to which the variant will be added.
     *
     * @return void
     */
    public function addToCart(AddProductVariantToCart $cart): void
    {
        $this->validate();
        $cart->add(
            variantId: $this->variant
        );
        $this->dispatch('productAddedToCart');
        $this->dispatch('notify', 'Added to cart');

    }

    #[Computed]
    public function product()
    {
        return Product::findOrFail($this->productId);
    }

    public function customerLogin()
    {
        return redirect(url('dashboard/login'));
    }
    public function render()
    {
        return view('livewire.product-info');
    }
}
