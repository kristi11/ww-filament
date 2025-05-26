<?php

namespace Tests\Feature\Models;

use App\Enums\Color;
use App\Enums\OutfitSizes;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductVariantTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_product_variant()
    {
        $product = Product::factory()->create();

        $variantData = [
            'product_id' => $product->id,
            'color' => Color::BLUE,
            'size' => OutfitSizes::M,
        ];

        $variant = ProductVariant::create($variantData);

        $this->assertInstanceOf(ProductVariant::class, $variant);
        $this->assertEquals($variantData['product_id'], $variant->product_id);
        $this->assertSame($variantData['color'], $variant->color);
        $this->assertSame($variantData['size'], $variant->size);
        $this->assertDatabaseHas('product_variants', [
            'product_id' => $product->id,
        ]);
    }

    /** @test */
    public function it_can_update_a_product_variant()
    {
        $variant = ProductVariant::factory()->create();
        $variantId = $variant->id;

        // Store original values
        $originalColor = $variant->color;
        $originalSize = $variant->size;

        // Update with new values
        $variant->update([
            'color' => Color::GREEN,
            'size' => OutfitSizes::L,
        ]);

        // Refresh from database
        $variant = ProductVariant::find($variantId);

        // Check that values have changed
        $this->assertNotEquals($originalColor, $variant->color);
        $this->assertNotEquals($originalSize, $variant->size);
    }

    /** @test */
    public function it_can_delete_a_product_variant()
    {
        $variant = ProductVariant::factory()->create();
        $variantId = $variant->id;

        $variant->delete();

        $this->assertDatabaseMissing('product_variants', ['id' => $variantId]);
    }

    /** @test */
    public function it_belongs_to_a_product()
    {
        $product = Product::factory()->create();
        $variant = ProductVariant::factory()->create(['product_id' => $product->id]);

        $this->assertInstanceOf(Product::class, $variant->product);
        $this->assertEquals($product->id, $variant->product->id);
    }

    /** @test */
    public function it_can_get_variant_attributes()
    {
        $attributes = ProductVariant::getVariantAttributes();

        $this->assertIsArray($attributes);
        $this->assertNotEmpty($attributes);

        // Check that some expected attributes are in the array
        $this->assertArrayHasKey('color', $attributes);
        $this->assertArrayHasKey('size', $attributes);
    }
}
