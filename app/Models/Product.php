<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Models\Concerns\HasObservers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, HasObservers;
    protected $casts = [
        'image' => 'array',
        'price' => 'int',
    ];

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
    ];

    function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value*100; // convert the price to cents before saving to the database
    }

    function getPriceAttribute($value)
    {
        return $value/100; // convert the price from cents when retrieving from the database
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
