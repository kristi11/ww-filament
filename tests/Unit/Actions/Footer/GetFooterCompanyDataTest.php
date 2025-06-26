<?php

namespace Tests\Unit\Actions\Footer;

use App\Actions\Footer\GetFooterCompanyData;
use App\Models\About;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class GetFooterCompanyDataTest extends TestCase
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
        $action = new GetFooterCompanyData;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('about', $result);
        $this->assertArrayHasKey('contact', $result);
        $this->assertNull($result['about']);
        $this->assertNull($result['contact']);
    }

    /** @test */
    public function it_returns_correct_data_when_all_models_exist()
    {
        // Arrange
        $user = User::factory()->create();

        $about = About::create([
            'user_id' => $user->id,
            'visibility' => true,
        ]);

        $contact = Contact::create([
            'user_id' => $user->id,
            'visibility' => false,
        ]);

        $action = new GetFooterCompanyData;

        // Act
        $result = $action->execute();

        // Assert
        $this->assertArrayHasKey('about', $result);
        $this->assertArrayHasKey('contact', $result);

        $this->assertTrue($result['about']);
        $this->assertFalse($result['contact']);
    }

    /** @test */
    public function it_caches_results()
    {
        // Arrange
        $user = User::factory()->create();

        $about = About::create([
            'user_id' => $user->id,
            'visibility' => true,
        ]);

        $action = new GetFooterCompanyData;

        // Act
        $action->execute();

        // Assert
        $this->assertTrue(Cache::has('footer_company_about'));

        // Change the visibility to ensure we're getting cached data
        $about->visibility = false;
        $about->save();

        $result = $action->execute();
        $this->assertTrue($result['about']);
    }
}
