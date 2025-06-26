<?php

namespace Tests\Unit\Actions\Footer;

use App\Actions\Footer\GetFooterLinksData;
use App\Models\FAQdata;
use App\Models\Help;
use App\Models\Support;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class GetFooterLinksDataTest extends TestCase
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
        $action = new GetFooterLinksData;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('faq', $result);
        $this->assertArrayHasKey('help', $result);
        $this->assertArrayHasKey('support', $result);
        $this->assertNull($result['faq']);
        $this->assertNull($result['help']);
        $this->assertNull($result['support']);
    }

    /** @test */
    public function it_returns_correct_data_when_all_models_exist()
    {
        // Arrange
        $user = User::factory()->create();

        $faq = FAQdata::create([
            'user_id' => $user->id,
            'visibility' => true,
        ]);

        $help = Help::create([
            'user_id' => $user->id,
            'visibility' => false,
        ]);

        $support = Support::create([
            'user_id' => $user->id,
            'visibility' => true,
        ]);

        $action = new GetFooterLinksData;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('faq', $result);
        $this->assertArrayHasKey('help', $result);
        $this->assertArrayHasKey('support', $result);

        $this->assertTrue($result['faq']);
        $this->assertFalse($result['help']);
        $this->assertTrue($result['support']);
    }

    /** @test */
    public function it_caches_results()
    {
        // Arrange
        $user = User::factory()->create();

        $faq = FAQdata::create([
            'user_id' => $user->id,
            'visibility' => true,
        ]);

        $action = new GetFooterLinksData;

        // Act
        $action->execute();

        // Assert
        $this->assertTrue(Cache::has('footer_links_faq'));

        // Change the visibility to ensure we're getting cached data
        $faq->visibility = false;
        $faq->save();

        $result = $action->execute();
        $this->assertTrue($result['faq']);
    }
}
