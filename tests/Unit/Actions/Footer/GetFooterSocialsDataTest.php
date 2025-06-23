<?php

namespace Tests\Unit\Actions\Footer;

use App\Actions\Footer\GetFooterSocialsData;
use App\Models\Hero;
use App\Models\Social;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class GetFooterSocialsDataTest extends TestCase
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
        $action = new GetFooterSocialsData();

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('social', $result);
        $this->assertArrayHasKey('hero', $result);
        $this->assertNull($result['social']);
        $this->assertNull($result['hero']);
    }

    /** @test */
    public function it_returns_correct_data_when_all_models_exist()
    {
        // Arrange
        $user = User::factory()->create();

        $hero = Hero::factory()->create([
            'user_id' => $user->id,
            'gradientDegreeFirstColor' => '#ff0000'
        ]);

        $social = Social::factory()->create([
            'user_id' => $user->id,
            'instagram' => 'test_instagram',
            'facebook' => 'test_facebook',
            'twitter' => 'test_twitter',
            'linkedin' => 'test_linkedin'
        ]);

        $action = new GetFooterSocialsData();

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('social', $result);
        $this->assertArrayHasKey('hero', $result);

        $this->assertInstanceOf(Social::class, $result['social']);
        $this->assertInstanceOf(Hero::class, $result['hero']);

        $this->assertEquals($social->id, $result['social']->id);
        $this->assertEquals($hero->id, $result['hero']->id);
        $this->assertEquals('test_instagram', $result['social']->instagram);
        $this->assertEquals('#ff0000', $result['hero']->gradientDegreeFirstColor);
    }

    /** @test */
    public function it_caches_results()
    {
        // Arrange
        $user = User::factory()->create();

        $social = Social::factory()->create([
            'user_id' => $user->id,
            'instagram' => 'test_instagram'
        ]);

        $action = new GetFooterSocialsData();

        // Act
        $action->execute();

        // Assert
        $this->assertTrue(Cache::has('footer_socials_data'));

        // Change the social data to ensure we're getting cached data
        $social->instagram = 'changed_instagram';
        $social->save();

        $result = $action->execute();
        $this->assertEquals('test_instagram', $result['social']->instagram);
    }
}
