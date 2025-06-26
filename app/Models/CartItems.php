<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Money\Currency;
use Money\Money;

class CartItems extends Model
{
    use HasFactory;

    protected $touches = ['cart'];

    protected $fillable = [
        'cart_id',
        'product_variant_id',
        'quantity',
    ];

    protected function subtotal(): Attribute
    {
        return Attribute::make(
            get: function () {
                $priceInCents = $this->product->price * 100;

                return new Money($priceInCents * $this->quantity, new Currency('USD'));
            }
        );
    }

    public function product(): HasOneThrough
    {
        return $this->hasOneThrough(
            Product::class,
            ProductVariant::class,
            'id',
            'id',
            'product_variant_id',
            'product_id'
        );
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
