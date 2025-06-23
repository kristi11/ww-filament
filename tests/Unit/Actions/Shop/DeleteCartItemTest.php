<?php

namespace Tests\Unit\Actions\Shop;

use App\Actions\Shop\DeleteCartItem;
use App\Factories\CartFactory;
use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class DeleteCartItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_cart_item_by_id()
    {
        // Arrange
        $cart = new Cart();
        $cart->save();

        $cartItem = CartItems::create([
            'cart_id' => $cart->id,
            'product_variant_id' => 1,
            'quantity' => 1
        ]);

        // Mock the CartFactory to return our test cart
        $cartFactoryMock = Mockery::mock('alias:' . CartFactory::class);
        $cartFactoryMock->shouldReceive('make')->andReturn($cart);

        $action = new DeleteCartItem();

        // Act
        $result = $action->execute($cartItem->id);

        // Assert
        $this->assertTrue($result);
        $this->assertDatabaseMissing('cart_items', ['id' => $cartItem->id]);
    }

    /** @test */
    public function it_returns_false_when_deleting_non_existent_item()
    {
        // Arrange
        $cart = new Cart();
        $cart->save();

        // Mock the CartFactory to return our test cart
        $cartFactoryMock = Mockery::mock('alias:' . CartFactory::class);
        $cartFactoryMock->shouldReceive('make')->andReturn($cart);

        $action = new DeleteCartItem();

        // Act
        $result = $action->execute(999); // Non-existent ID

        // Assert
        $this->assertFalse($result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
