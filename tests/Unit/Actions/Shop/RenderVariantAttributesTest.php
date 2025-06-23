<?php

namespace Tests\Unit\Actions\Shop;

use App\Actions\Shop\RenderVariantAttributes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use stdClass;
use Tests\TestCase;

class RenderVariantAttributesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_formats_variant_attributes_with_enum_values()
    {
        // Arrange
        // Create a mock enum class
        $mockEnum = new class {
            public function getLabel()
            {
                return 'Test Label';
            }
        };

        // Create a mock variant object
        $variant = new stdClass();
        $variant->color = $mockEnum;
        $variant->size = 'Large';

        // Mock the config to return our enum mappings
        Config::set('enums', [
            'color' => get_class($mockEnum),
            'size' => 'string'
        ]);

        $action = new RenderVariantAttributes();

        // Act
        $result = $action->execute($variant);

        // Assert
        $this->assertEquals([
            'color' => 'Color: Test Label',
            'size' => 'Size: Large'
        ], $result);
    }

    /** @test */
    public function it_handles_missing_attributes()
    {
        // Arrange
        // Create a mock variant object with only one attribute
        $variant = new stdClass();
        $variant->color = 'Red';

        // Mock the config to return our enum mappings
        Config::set('enums', [
            'color' => 'string',
            'size' => 'string'
        ]);

        $action = new RenderVariantAttributes();

        // Act
        $result = $action->execute($variant);

        // Assert
        $this->assertEquals([
            'color' => 'Color: Red'
        ], $result);
        $this->assertArrayNotHasKey('size', $result);
    }

    /** @test */
    public function it_returns_empty_array_when_no_enum_mappings()
    {
        // Arrange
        $variant = new stdClass();
        $variant->color = 'Red';

        // Mock the config to return empty enum mappings
        Config::set('enums', []);

        $action = new RenderVariantAttributes();

        // Act
        $result = $action->execute($variant);

        // Assert
        $this->assertEmpty($result);
    }
}
