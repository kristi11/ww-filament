<?php

namespace Tests\Unit\Actions\Shop;

use App\Actions\Shop\UpdateCartItemQuantity;
use App\Factories\CartFactory;
use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class UpdateCartItemQuantityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_increments_cart_item_quantity()
    {
        // Arrange
        $cart = new Cart;
        $cart->save();

        $cartItem = CartItems::create([
            'cart_id' => $cart->id,
            'product_variant_id' => 1,
            'quantity' => 1,
        ]);

        // Mock the CartFactory to return our test cart
        $cartFactoryMock = Mockery::mock('alias:'.CartFactory::class);
        $cartFactoryMock->shouldReceive('make')->andReturn($cart);

        $action = new UpdateCartItemQuantity;

        // Act
        $result = $action->increment($cartItem->id);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(2, $cartItem->fresh()->quantity);
    }

    /** @test */
    public function it_returns_false_when_incrementing_non_existent_item()
    {
        // Arrange
        $cart = new Cart;
        $cart->save();

        // Mock the CartFactory to return our test cart
        $cartFactoryMock = Mockery::mock('alias:'.CartFactory::class);
        $cartFactoryMock->shouldReceive('make')->andReturn($cart);

        $action = new UpdateCartItemQuantity;

        // Act
        $result = $action->increment(999); // Non-existent ID

        // Assert
        $this->assertFalse($result);
    }

    /** @test */
    public function it_decrements_cart_item_quantity()
    {
        // Arrange
        $cart = new Cart;
        $cart->save();

        $cartItem = CartItems::create([
            'cart_id' => $cart->id,
            'product_variant_id' => 1,
            'quantity' => 2,
        ]);

        // Mock the CartFactory to return our test cart
        $cartFactoryMock = Mockery::mock('alias:'.CartFactory::class);
        $cartFactoryMock->shouldReceive('make')->andReturn($cart);

        $action = new UpdateCartItemQuantity;

        // Act
        $result = $action->decrement($cartItem->id);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals(1, $cartItem->fresh()->quantity);
    }

    /** @test */
    public function it_does_not_decrement_below_one()
    {
        // Arrange
        $cart = new Cart;
        $cart->save();

        $cartItem = CartItems::create([
            'cart_id' => $cart->id,
            'product_variant_id' => 1,
            'quantity' => 1,
        ]);

        // Mock the CartFactory to return our test cart
        $cartFactoryMock = Mockery::mock('alias:'.CartFactory::class);
        $cartFactoryMock->shouldReceive('make')->andReturn($cart);

        $action = new UpdateCartItemQuantity;

        // Act
        $result = $action->decrement($cartItem->id);

        // Assert
        $this->assertFalse($result);
        $this->assertEquals(1, $cartItem->fresh()->quantity);
    }

    /** @test */
    public function it_returns_false_when_decrementing_non_existent_item()
    {
        // Arrange
        $cart = new Cart;
        $cart->save();

        // Mock the CartFactory to return our test cart
        $cartFactoryMock = Mockery::mock('alias:'.CartFactory::class);
        $cartFactoryMock->shouldReceive('make')->andReturn($cart);

        $action = new UpdateCartItemQuantity;

        // Act
        $result = $action->decrement(999); // Non-existent ID

        // Assert
        $this->assertFalse($result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
