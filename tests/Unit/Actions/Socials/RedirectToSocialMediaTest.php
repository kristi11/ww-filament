<?php

namespace Tests\Unit\Actions\Socials;

use App\Actions\Socials\RedirectToSocialMedia;
use App\Models\Social;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class RedirectToSocialMediaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    /** @test */
    public function it_returns_null_when_no_social_data_exists()
    {
        // Arrange
        $action = new RedirectToSocialMedia();

        // Act
        $result = $action->execute('instagram');

        // Assert
        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_null_when_platform_is_invalid()
    {
        // Arrange
        $user = User::factory()->create();
        Social::create([
            'user_id' => $user->id,
            'instagram' => 'test_instagram',
            'facebook' => 'test_facebook',
            'linkedin' => 'test_linkedin',
            'twitter' => 'test_twitter'
        ]);
        $action = new RedirectToSocialMedia();

        // Act
        $result = $action->execute('invalid_platform');

        // Assert
        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_null_when_social_handle_is_empty()
    {
        // Arrange
        $user = User::factory()->create();
        Social::create([
            'user_id' => $user->id,
            'instagram' => '',
            'facebook' => 'test_facebook',
            'linkedin' => 'test_linkedin',
            'twitter' => 'test_twitter'
        ]);
        $action = new RedirectToSocialMedia();

        // Act
        $result = $action->execute('instagram');

        // Assert
        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_correct_url_for_instagram()
    {
        // Arrange
        $user = User::factory()->create();
        Social::create([
            'user_id' => $user->id,
            'instagram' => 'test_instagram',
            'facebook' => 'test_facebook',
            'linkedin' => 'test_linkedin',
            'twitter' => 'test_twitter'
        ]);
        $action = new RedirectToSocialMedia();

        // Act
        $result = $action->execute('instagram');

        // Assert
        $this->assertEquals('https://www.instagram.com/test_instagram', $result);
    }

    /** @test */
    public function it_returns_correct_url_for_facebook()
    {
        // Arrange
        $user = User::factory()->create();
        Social::create([
            'user_id' => $user->id,
            'instagram' => 'test_instagram',
            'facebook' => 'test_facebook',
            'linkedin' => 'test_linkedin',
            'twitter' => 'test_twitter'
        ]);
        $action = new RedirectToSocialMedia();

        // Act
        $result = $action->execute('facebook');

        // Assert
        $this->assertEquals('https://www.facebook.com/test_facebook', $result);
    }

    /** @test */
    public function it_returns_correct_url_for_linkedin()
    {
        // Arrange
        $user = User::factory()->create();
        Social::create([
            'user_id' => $user->id,
            'instagram' => 'test_instagram',
            'facebook' => 'test_facebook',
            'linkedin' => 'test_linkedin',
            'twitter' => 'test_twitter'
        ]);
        $action = new RedirectToSocialMedia();

        // Act
        $result = $action->execute('linkedin');

        // Assert
        $this->assertEquals('https://www.linkedin.com/in/test_linkedin', $result);
    }

    /** @test */
    public function it_returns_correct_url_for_twitter()
    {
        // Arrange
        $user = User::factory()->create();
        Social::create([
            'user_id' => $user->id,
            'instagram' => 'test_instagram',
            'facebook' => 'test_facebook',
            'linkedin' => 'test_linkedin',
            'twitter' => 'test_twitter'
        ]);
        $action = new RedirectToSocialMedia();

        // Act
        $result = $action->execute('twitter');

        // Assert
        $this->assertEquals('https://twitter.com/test_twitter', $result);
    }

    /** @test */
    public function it_caches_social_data()
    {
        // Arrange
        $user = User::factory()->create();
        $social = Social::create([
            'user_id' => $user->id,
            'instagram' => 'test_instagram',
            'facebook' => 'test_facebook',
            'linkedin' => 'test_linkedin',
            'twitter' => 'test_twitter'
        ]);
        $action = new RedirectToSocialMedia();

        // Act
        $action->execute('instagram');

        // Assert
        $this->assertTrue(Cache::has('social_data'));

        // Delete the social record to ensure we're getting cached data
        $social->delete();

        // Should still work because of cache
        $result = $action->execute('instagram');
        $this->assertEquals('https://www.instagram.com/test_instagram', $result);
    }
}
