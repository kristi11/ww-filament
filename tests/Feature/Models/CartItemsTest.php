<?php

namespace Tests\Feature\Models;

use App\Models\Cart;
use App\Models\CartItems;
use App\Models\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartItemsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_cart_item()
    {
        $cart = Cart::factory()->create();
        $productVariant = ProductVariant::factory()->create();

        $cartItemData = [
            'cart_id' => $cart->id,
            'product_variant_id' => $productVariant->id,
            'quantity' => 2,
        ];

        $cartItem = CartItems::create($cartItemData);

        $this->assertInstanceOf(CartItems::class, $cartItem);
        $this->assertEquals($cartItemData['cart_id'], $cartItem->cart_id);
        $this->assertEquals($cartItemData['product_variant_id'], $cartItem->product_variant_id);
        $this->assertEquals($cartItemData['quantity'], $cartItem->quantity);
        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $cart->id,
            'product_variant_id' => $productVariant->id,
            'quantity' => 2,
        ]);
    }

    /** @test */
    public function it_can_update_a_cart_item()
    {
        $cartItem = CartItems::factory()->create(['quantity' => 1]);

        $newData = [
            'quantity' => 3,
        ];

        $cartItem->update($newData);
        $cartItem->refresh();

        $this->assertEquals($newData['quantity'], $cartItem->quantity);
    }

    /** @test */
    public function it_can_delete_a_cart_item()
    {
        $cartItem = CartItems::factory()->create();
        $cartItemId = $cartItem->id;

        $cartItem->delete();

        $this->assertDatabaseMissing('cart_items', ['id' => $cartItemId]);
    }

    /** @test */
    public function it_belongs_to_a_cart()
    {
        $cart = Cart::factory()->create();
        $cartItem = CartItems::factory()->create(['cart_id' => $cart->id]);

        $this->assertInstanceOf(Cart::class, $cartItem->cart);
        $this->assertEquals($cart->id, $cartItem->cart->id);
    }

    /** @test */
    public function it_belongs_to_a_product_variant()
    {
        $productVariant = ProductVariant::factory()->create();
        $cartItem = CartItems::factory()->create(['product_variant_id' => $productVariant->id]);

        $this->assertInstanceOf(ProductVariant::class, $cartItem->variant);
        $this->assertEquals($productVariant->id, $cartItem->variant->id);
    }
}
