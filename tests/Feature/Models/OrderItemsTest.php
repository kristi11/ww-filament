<?php

namespace Tests\Feature\Models;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderItemsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_an_order_item()
    {
        $order = Order::factory()->create();
        $productVariant = ProductVariant::factory()->create();

        $orderItemData = [
            'order_id' => $order->id,
            'product_variant_id' => $productVariant->id,
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 1000,
            'quantity' => 2,
            'amount_discount' => 0,
            'amount_subtotal' => 2000,
            'amount_tax' => 200,
            'amount_total' => 2200,
        ];

        $orderItem = OrderItems::create($orderItemData);

        $this->assertInstanceOf(OrderItems::class, $orderItem);
        $this->assertEquals($orderItemData['order_id'], $orderItem->order_id);
        $this->assertEquals($orderItemData['product_variant_id'], $orderItem->product_variant_id);
        $this->assertEquals($orderItemData['name'], $orderItem->name);
        $this->assertEquals($orderItemData['description'], $orderItem->description);
        $this->assertEquals($orderItemData['price'], $orderItem->price->getAmount());
        $this->assertEquals($orderItemData['quantity'], $orderItem->quantity);
        $this->assertEquals($orderItemData['amount_total'], $orderItem->amount_total->getAmount());
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_variant_id' => $productVariant->id,
            'name' => 'Test Product',
        ]);
    }

    /** @test */
    public function it_can_update_an_order_item()
    {
        $orderItem = OrderItems::factory()->create([
            'quantity' => 1,
            'price' => 1000,
        ]);

        $newData = [
            'quantity' => 3,
            'price' => 1500,
        ];

        $orderItem->update($newData);
        $orderItem->refresh();

        $this->assertEquals($newData['quantity'], $orderItem->quantity);
        $this->assertEquals($newData['price'], $orderItem->price->getAmount());
    }

    /** @test */
    public function it_can_delete_an_order_item()
    {
        $orderItem = OrderItems::factory()->create();
        $orderItemId = $orderItem->id;

        $orderItem->delete();

        $this->assertDatabaseMissing('order_items', ['id' => $orderItemId]);
    }

    /** @test */
    public function it_belongs_to_an_order()
    {
        $order = Order::factory()->create();
        $orderItem = OrderItems::factory()->create(['order_id' => $order->id]);

        $this->assertInstanceOf(Order::class, $orderItem->order);
        $this->assertEquals($order->id, $orderItem->order->id);
    }
}
