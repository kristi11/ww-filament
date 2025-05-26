<?php

namespace Tests\Feature\Models;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_product()
    {
        $productData = [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 19.99,
            'image' => ['url' => 'test.jpg'],
        ];

        $product = Product::create($productData);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals($productData['name'], $product->name);
        $this->assertEquals($productData['description'], $product->description);
        $this->assertEquals($productData['price'], $product->price);
        $this->assertEquals($productData['image'], $product->image);
        $this->assertDatabaseHas('products', [
            'name' => $productData['name'],
            'description' => $productData['description'],
        ]);
    }

    /** @test */
    public function it_can_update_a_product()
    {
        $product = Product::factory()->create();

        $newData = [
            'name' => 'Updated Product',
            'description' => 'This is an updated product',
            'price' => 29.99,
        ];

        $product->update($newData);
        $product->refresh();

        $this->assertEquals($newData['name'], $product->name);
        $this->assertEquals($newData['description'], $product->description);
        $this->assertEquals($newData['price'], $product->price);
    }

    /** @test */
    public function it_can_delete_a_product()
    {
        $product = Product::factory()->create();
        $productId = $product->id;

        $product->delete();

        $this->assertDatabaseMissing('products', ['id' => $productId]);
    }

    /** @test */
    public function it_has_many_variants()
    {
        $product = Product::factory()->create();
        $variant = ProductVariant::factory()->create(['product_id' => $product->id]);

        $this->assertInstanceOf(ProductVariant::class, $product->variants->first());
        $this->assertEquals($variant->id, $product->variants->first()->id);
    }

    /** @test */
    public function it_converts_price_to_cents_when_saving()
    {
        $product = Product::factory()->create(['price' => 19.99]);

        // Check the raw value in the database (should be in cents)
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'price' => 1999, // 19.99 * 100
        ]);
    }

    /** @test */
    public function it_converts_price_from_cents_when_retrieving()
    {
        $product = Product::factory()->create(['price' => 19.99]);

        // The price should be converted back to dollars when accessed
        $this->assertEquals(19.99, $product->price);
    }
}
