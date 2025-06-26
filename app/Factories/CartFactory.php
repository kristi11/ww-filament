<?php

namespace App\Factories;

use App\Models\Cart;

class CartFactory
{
    public static function make(): Cart
    {
        return match (auth()->guest()) {
            true => Cart::firstOrCreate(['session_id' => session()->getId()]),
            false => auth()->user()->cart ?: auth()->user()->cart()->create()
        };
    }
}
