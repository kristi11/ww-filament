<?php

namespace Tests\Feature\Models;

use App\Models\PublicPage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicPageTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_public_page()
    {
        $user = User::factory()->create();

        $publicPageData = [
            'user_id' => $user->id,
            'hero' => true,
            'credentials' => true,
            'services' => true,
            'shop' => false,
            'hours' => true,
            'gallery' => false,
            'email' => true,
            'footer' => true,
        ];

        $publicPage = PublicPage::create($publicPageData);

        $this->assertInstanceOf(PublicPage::class, $publicPage);
        $this->assertEquals($publicPageData['user_id'], $publicPage->user_id);
        $this->assertEquals($publicPageData['hero'], $publicPage->hero);
        $this->assertEquals($publicPageData['credentials'], $publicPage->credentials);
        $this->assertEquals($publicPageData['services'], $publicPage->services);
        $this->assertEquals($publicPageData['shop'], $publicPage->shop);
        $this->assertEquals($publicPageData['hours'], $publicPage->hours);
        $this->assertEquals($publicPageData['gallery'], $publicPage->gallery);
        $this->assertEquals($publicPageData['email'], $publicPage->email);
        $this->assertEquals($publicPageData['footer'], $publicPage->footer);
        $this->assertDatabaseHas('public_pages', [
            'user_id' => $user->id,
            'shop' => false,
            'gallery' => false,
        ]);
    }

    /** @test */
    public function it_can_update_a_public_page()
    {
        $publicPage = PublicPage::factory()->create([
            'shop' => true,
            'gallery' => true,
        ]);

        $newData = [
            'shop' => false,
            'gallery' => false,
        ];

        $publicPage->update($newData);
        $publicPage->refresh();

        $this->assertEquals($newData['shop'], $publicPage->shop);
        $this->assertEquals($newData['gallery'], $publicPage->gallery);
    }

    /** @test */
    public function it_can_delete_a_public_page()
    {
        $publicPage = PublicPage::factory()->create();
        $publicPageId = $publicPage->id;

        $publicPage->delete();

        $this->assertDatabaseMissing('public_pages', ['id' => $publicPageId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $publicPage = PublicPage::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $publicPage->user);
        $this->assertEquals($user->id, $publicPage->user->id);
    }

    /** @test */
    public function it_implements_to_html_method()
    {
        $publicPage = PublicPage::factory()->create();

        $this->assertIsString($publicPage->toHtml());
        $this->assertEquals('', $publicPage->toHtml());
    }
}
