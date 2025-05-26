<?php

namespace Tests\Feature\Models;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_an_order()
    {
        $user = User::factory()->create();

        $orderData = [
            'user_id' => $user->id,
            'stripe_checkout_session_id' => $this->faker->uuid,
            'amount_shipping' => 500,
            'amount_discount' => 200,
            'amount_tax' => 300,
            'amount_subtotal' => 1000,
            'amount_total' => 1600,
            'billing_address' => ['street' => '123 Main St', 'city' => 'Anytown'],
            'shipping_address' => ['street' => '123 Main St', 'city' => 'Anytown'],
        ];

        $order = Order::create($orderData);

        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals($orderData['user_id'], $order->user_id);
        $this->assertEquals($orderData['stripe_checkout_session_id'], $order->stripe_checkout_session_id);
        $this->assertEquals($orderData['amount_shipping'], $order->amount_shipping->getAmount());
        $this->assertEquals($orderData['amount_total'], $order->amount_total->getAmount());
        $this->assertEquals($orderData['billing_address'], $order->billing_address->toArray());
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'stripe_checkout_session_id' => $orderData['stripe_checkout_session_id'],
        ]);
    }

    /** @test */
    public function it_can_update_an_order()
    {
        $order = Order::factory()->create();

        $newData = [
            'stripe_checkout_session_id' => $this->faker->uuid,
            'amount_shipping' => 600,
        ];

        $order->update($newData);
        $order->refresh();

        $this->assertEquals($newData['stripe_checkout_session_id'], $order->stripe_checkout_session_id);
        $this->assertEquals($newData['amount_shipping'], $order->amount_shipping->getAmount());
    }

    /** @test */
    public function it_can_delete_an_order()
    {
        $order = Order::factory()->create();
        $orderId = $order->id;

        $order->delete();

        $this->assertDatabaseMissing('orders', ['id' => $orderId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $order->user);
        $this->assertEquals($user->id, $order->user->id);
    }

    /** @test */
    public function it_has_many_items()
    {
        $order = Order::factory()->create();
        $orderItem = OrderItems::factory()->create(['order_id' => $order->id]);

        $this->assertInstanceOf(OrderItems::class, $order->items->first());
        $this->assertEquals($orderItem->id, $order->items->first()->id);
    }

    /** @test */
    public function it_can_calculate_total_quantity()
    {
        $order = Order::factory()->create();
        OrderItems::factory()->create(['order_id' => $order->id, 'quantity' => 2]);
        OrderItems::factory()->create(['order_id' => $order->id, 'quantity' => 3]);

        $this->assertEquals(5, $order->total_quantity);
    }
}
