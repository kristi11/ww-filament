<?php

namespace Tests\Unit\Actions\Services;

use App\Actions\Services\CheckFlexiblePricing;
use App\Models\Flexibility;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CheckFlexiblePricingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    /** @test */
    public function it_returns_null_when_no_flexible_pricing_exists()
    {
        // Arrange
        $action = new CheckFlexiblePricing;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_flexibility_model_when_flexible_pricing_is_enabled()
    {
        // Arrange
        $user = User::factory()->create();
        Flexibility::create([
            'user_id' => $user->id,
            'flexible_pricing' => true,
        ]);
        $action = new CheckFlexiblePricing;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertInstanceOf(Flexibility::class, $result);
        $this->assertEquals(1, $result->flexible_pricing);
    }

    /** @test */
    public function it_caches_results()
    {
        // Arrange
        $user = User::factory()->create();
        Flexibility::create([
            'user_id' => $user->id,
            'flexible_pricing' => true,
        ]);
        $action = new CheckFlexiblePricing;
        $cacheKey = 'flexible_pricing';

        // Act
        $action->execute();

        // Assert
        $this->assertTrue(Cache::has($cacheKey));
    }

    /** @test */
    public function it_returns_cached_result_when_available()
    {
        // Arrange
        $user = User::factory()->create();
        $flexibility = Flexibility::create([
            'user_id' => $user->id,
            'flexible_pricing' => true,
        ]);
        $action = new CheckFlexiblePricing;
        $cacheKey = 'flexible_pricing';

        // Cache a value manually
        Cache::put($cacheKey, $flexibility, now()->addMinutes(60));

        // Delete the record from the database to ensure we're getting the cached version
        $flexibility->delete();

        // Act
        $result = $action->execute();

        // Assert
        $this->assertInstanceOf(Flexibility::class, $result);
        $this->assertEquals(1, $result->flexible_pricing);
    }
}
