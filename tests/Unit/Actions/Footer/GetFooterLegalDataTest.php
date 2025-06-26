<?php

namespace Tests\Unit\Actions\Footer;

use App\Actions\Footer\GetFooterLegalData;
use App\Models\Privacy;
use App\Models\Terms;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class GetFooterLegalDataTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    /** @test */
    public function it_returns_null_values_when_no_data_exists()
    {
        // Arrange
        $action = new GetFooterLegalData;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('terms', $result);
        $this->assertArrayHasKey('privacy', $result);
        $this->assertNull($result['terms']);
        $this->assertNull($result['privacy']);
    }

    /** @test */
    public function it_returns_correct_data_when_all_models_exist()
    {
        // Arrange
        $user = User::factory()->create();

        $terms = Terms::create([
            'user_id' => $user->id,
            'visibility' => true,
        ]);

        $privacy = Privacy::create([
            'user_id' => $user->id,
            'visibility' => false,
        ]);

        $action = new GetFooterLegalData;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('terms', $result);
        $this->assertArrayHasKey('privacy', $result);

        $this->assertTrue($result['terms']);
        $this->assertFalse($result['privacy']);
    }

    /** @test */
    public function it_caches_results()
    {
        // Arrange
        $user = User::factory()->create();

        $terms = Terms::create([
            'user_id' => $user->id,
            'visibility' => true,
        ]);

        $action = new GetFooterLegalData;

        // Act
        $action->execute();

        // Assert
        $this->assertTrue(Cache::has('footer_legal_terms'));

        // Change the visibility to ensure we're getting cached data
        $terms->visibility = false;
        $terms->save();

        $result = $action->execute();
        $this->assertTrue($result['terms']);
    }
}
