<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Money\Currency;
use Money\Money;

/**
 * @property mixed $items
 */
class Cart extends Model
{
    use HasFactory;

    protected function total(): Attribute
    {
        return  Attribute::make(
            get: function (){
                return $this->items->reduce(function(Money $total, CartItems $item){
                    return $total->add($item->subtotal);
                }, new Money(0, new Currency('USD')));
            }
        );
    }

    public function cart():HasMany
    {
        return $this->hasMany(CartItems::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItems::class);
    }
}
