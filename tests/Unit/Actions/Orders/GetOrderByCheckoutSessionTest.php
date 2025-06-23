<?php

namespace Tests\Unit\Actions\Orders;

use App\Actions\Orders\GetOrderByCheckoutSession;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetOrderByCheckoutSessionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_null_when_no_order_exists_with_given_session_id()
    {
        // Arrange
        $user = User::factory()->create();
        $sessionId = 'non_existent_session_id';
        $action = new GetOrderByCheckoutSession();

        // Act
        $result = $action->execute($sessionId, $user->id);

        // Assert
        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_null_when_order_exists_but_belongs_to_different_user()
    {
        // Arrange
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $sessionId = 'test_session_id';

        // Create an order for user1
        Order::factory()->create([
            'user_id' => $user1->id,
            'stripe_checkout_session_id' => $sessionId
        ]);

        $action = new GetOrderByCheckoutSession();

        // Act - Try to get the order as user2
        $result = $action->execute($sessionId, $user2->id);

        // Assert
        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_order_when_it_exists_for_given_user_and_session_id()
    {
        // Arrange
        $user = User::factory()->create();
        $sessionId = 'test_session_id';

        // Create an order for the user
        $order = Order::factory()->create([
            'user_id' => $user->id,
            'stripe_checkout_session_id' => $sessionId
        ]);

        $action = new GetOrderByCheckoutSession();

        // Act
        $result = $action->execute($sessionId, $user->id);

        // Assert
        $this->assertNotNull($result);
        $this->assertEquals($order->id, $result->id);
        $this->assertEquals($user->id, $result->user_id);
        $this->assertEquals($sessionId, $result->stripe_checkout_session_id);
    }
}
