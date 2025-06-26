<?php

namespace Tests\Unit\Actions\Shop;

use App\Actions\Shop\GetProductById;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetProductByIdTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_product_when_found()
    {
        // Arrange
        $product = Product::factory()->create();
        $action = new GetProductById;

        // Act
        $result = $action->execute($product->id);

        // Assert
        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals($product->id, $result->id);
    }

    /** @test */
    public function it_throws_exception_when_product_not_found()
    {
        // Arrange
        $action = new GetProductById;

        // Assert
        $this->expectException(ModelNotFoundException::class);

        // Act
        $action->execute(999); // Non-existent ID
    }
}
