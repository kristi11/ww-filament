<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ShopProducts extends Component
{
    use WithPagination;

    #[Url]
    public $keywords;

    #[Computed]
    public function product()
    {
        return Product::query()
            ->latest()
            ->when($this->keywords, fn ($query) => $query->where('name', 'like', '%' . $this->keywords . '%'))
            ->Paginate(6);
    }

    public function render()
    {
        return view('livewire.shop-products');
    }
}
