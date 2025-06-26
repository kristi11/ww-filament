<?php

namespace Tests\Unit\Actions\Heroes;

use App\Actions\Heroes\GetHeroData;
use App\Models\Hero;
use App\Models\PublicPage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetHeroDataTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_hero_and_public_status_when_hero_exists_and_is_public()
    {
        // Arrange
        $user = User::factory()->create();
        $hero = Hero::factory()->create();
        PublicPage::create([
            'user_id' => $user->id,
            'hero' => true,
        ]);
        $action = new GetHeroData;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('hero', $result);
        $this->assertArrayHasKey('publicHero', $result);
        $this->assertEquals($hero->id, $result['hero']->id);
        $this->assertEquals(1, $result['publicHero']);
    }

    /** @test */
    public function it_returns_hero_and_false_public_status_when_hero_exists_but_is_not_public()
    {
        // Arrange
        $user = User::factory()->create();
        $hero = Hero::factory()->create();
        PublicPage::create([
            'user_id' => $user->id,
            'hero' => false,
        ]);
        $action = new GetHeroData;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('hero', $result);
        $this->assertArrayHasKey('publicHero', $result);
        $this->assertEquals($hero->id, $result['hero']->id);
        $this->assertEquals(0, $result['publicHero']);
    }

    /** @test */
    public function it_returns_null_hero_when_no_hero_exists()
    {
        // Arrange
        $user = User::factory()->create();
        PublicPage::create([
            'user_id' => $user->id,
            'hero' => true,
        ]);
        $action = new GetHeroData;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('hero', $result);
        $this->assertArrayHasKey('publicHero', $result);
        $this->assertNull($result['hero']);
        $this->assertEquals(1, $result['publicHero']);
    }

    /** @test */
    public function it_returns_default_true_public_status_when_public_page_does_not_exist()
    {
        // Arrange
        $hero = Hero::factory()->create();
        $action = new GetHeroData;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('hero', $result);
        $this->assertArrayHasKey('publicHero', $result);
        $this->assertEquals($hero->id, $result['hero']->id);
        $this->assertEquals(1, $result['publicHero']);
    }
}
