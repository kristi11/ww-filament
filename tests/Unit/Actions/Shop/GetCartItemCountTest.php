<?php

namespace Tests\Unit\Actions\Shop;

use App\Actions\Shop\GetCartItemCount;
use App\Factories\CartFactory;
use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class GetCartItemCountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_zero_when_cart_has_no_items()
    {
        // Arrange
        $cart = new Cart();
        $cart->save();

        // Mock the CartFactory to return our test cart
        $cartFactoryMock = Mockery::mock('alias:' . CartFactory::class);
        $cartFactoryMock->shouldReceive('make')->andReturn($cart);

        $action = new GetCartItemCount();

        // Act
        $result = $action->execute();

        // Assert
        $this->assertEquals(0, $result);
    }

    /** @test */
    public function it_returns_sum_of_quantities_for_all_cart_items()
    {
        // Arrange
        $cart = new Cart();
        $cart->save();

        // Create cart items with different quantities
        CartItems::create([
            'cart_id' => $cart->id,
            'product_variant_id' => 1,
            'quantity' => 2
        ]);

        CartItems::create([
            'cart_id' => $cart->id,
            'product_variant_id' => 2,
            'quantity' => 3
        ]);

        // Mock the CartFactory to return our test cart
        $cartFactoryMock = Mockery::mock('alias:' . CartFactory::class);
        $cartFactoryMock->shouldReceive('make')->andReturn($cart);

        $action = new GetCartItemCount();

        // Act
        $result = $action->execute();

        // Assert
        $this->assertEquals(5, $result); // 2 + 3 = 5
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
