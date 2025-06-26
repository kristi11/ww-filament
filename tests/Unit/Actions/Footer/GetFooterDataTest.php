<?php

namespace Tests\Unit\Actions\Footer;

use App\Actions\Footer\GetFooterData;
use App\Models\Hero;
use App\Models\PublicPage;
use App\Models\SectionColors;
use App\Models\Social;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class GetFooterDataTest extends TestCase
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
        $action = new GetFooterData;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('hero', $result);
        $this->assertArrayHasKey('background', $result);
        $this->assertArrayHasKey('social', $result);
        $this->assertArrayHasKey('footer', $result);
        $this->assertNull($result['hero']);
        $this->assertNull($result['background']);
        $this->assertNull($result['social']);
        $this->assertNull($result['footer']);
    }

    /** @test */
    public function it_returns_correct_data_when_all_models_exist()
    {
        // Arrange
        $user = User::factory()->create();

        $hero = Hero::factory()->create([
            'user_id' => $user->id,
            'gradientDegreeFirstColor' => '#ff0000',
        ]);

        $background = SectionColors::factory()->create([
            'user_id' => $user->id,
            'footerBackgroundColor' => 'bg-gray-100',
        ]);

        $social = Social::factory()->create([
            'user_id' => $user->id,
            'instagram' => 'test_instagram',
        ]);

        $publicPage = PublicPage::factory()->create([
            'user_id' => $user->id,
            'footer' => true,
        ]);

        $action = new GetFooterData;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('hero', $result);
        $this->assertArrayHasKey('background', $result);
        $this->assertArrayHasKey('social', $result);
        $this->assertArrayHasKey('footer', $result);

        $this->assertInstanceOf(Hero::class, $result['hero']);
        $this->assertInstanceOf(SectionColors::class, $result['background']);
        $this->assertInstanceOf(Social::class, $result['social']);
        $this->assertInstanceOf(PublicPage::class, $result['footer']);

        $this->assertEquals($hero->id, $result['hero']->id);
        $this->assertEquals($background->id, $result['background']->id);
        $this->assertEquals($social->id, $result['social']->id);
        $this->assertEquals($publicPage->id, $result['footer']->id);
    }

    /** @test */
    public function it_caches_results()
    {
        // Arrange
        $user = User::factory()->create();

        $hero = Hero::factory()->create([
            'user_id' => $user->id,
        ]);

        $action = new GetFooterData;

        // Act
        $action->execute();

        // Assert
        $this->assertTrue(Cache::has('footer_hero'));

        // Delete the hero to ensure we're getting cached data
        $hero->delete();

        $result = $action->execute();
        $this->assertInstanceOf(Hero::class, $result['hero']);
        $this->assertEquals($hero->id, $result['hero']->id);
    }
}
