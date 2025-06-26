<?php

namespace Tests\Feature\Models;

use App\Models\Cart;
use App\Models\CartItems;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_cart()
    {
        $user = User::factory()->create();

        $cartData = [
            'user_id' => $user->id,
            'session_id' => $this->faker->uuid,
        ];

        $cart = Cart::create($cartData);

        $this->assertInstanceOf(Cart::class, $cart);
        $this->assertEquals($cartData['user_id'], $cart->user_id);
        $this->assertEquals($cartData['session_id'], $cart->session_id);
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'session_id' => $cartData['session_id'],
        ]);
    }

    /** @test */
    public function it_can_update_a_cart()
    {
        $cart = Cart::factory()->create();

        $newData = [
            'session_id' => $this->faker->uuid,
        ];

        $cart->update($newData);
        $cart->refresh();

        $this->assertEquals($newData['session_id'], $cart->session_id);
    }

    /** @test */
    public function it_can_delete_a_cart()
    {
        $cart = Cart::factory()->create();
        $cartId = $cart->id;

        $cart->delete();

        $this->assertDatabaseMissing('carts', ['id' => $cartId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $cart->user);
        $this->assertEquals($user->id, $cart->user->id);
    }

    /** @test */
    public function it_has_many_items()
    {
        $cart = Cart::factory()->create();
        $cartItem = CartItems::factory()->create(['cart_id' => $cart->id]);

        $this->assertInstanceOf(CartItems::class, $cart->items->first());
        $this->assertEquals($cartItem->id, $cart->items->first()->id);
    }
}
