<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Money\Currency;
use Money\Money;

class StoreFront extends Component
{

    #[Computed]
    public function products()
    {
        return Product::query()->get();
    }
    public function render()
    {
        return view('livewire.store-front');
    }
}
