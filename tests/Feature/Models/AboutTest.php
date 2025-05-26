<?php

namespace Tests\Feature\Models;

use App\Models\About;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AboutTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_an_about()
    {
        $user = User::factory()->create();

        $aboutData = [
            'user_id' => $user->id,
            'content' => 'This is about content',
            'visibility' => true,
        ];

        $about = About::create($aboutData);

        $this->assertInstanceOf(About::class, $about);
        $this->assertEquals($aboutData['user_id'], $about->user_id);
        $this->assertEquals($aboutData['content'], $about->content);
        $this->assertEquals($aboutData['visibility'], $about->visibility);
        $this->assertDatabaseHas('abouts', [
            'user_id' => $user->id,
            'content' => 'This is about content',
        ]);
    }

    /** @test */
    public function it_can_update_an_about()
    {
        $about = About::factory()->create();

        $newData = [
            'content' => 'Updated about content',
            'visibility' => false,
        ];

        $about->update($newData);
        $about->refresh();

        $this->assertEquals($newData['content'], $about->content);
        $this->assertEquals($newData['visibility'], $about->visibility);
    }

    /** @test */
    public function it_can_delete_an_about()
    {
        $about = About::factory()->create();
        $aboutId = $about->id;

        $about->delete();

        $this->assertDatabaseMissing('abouts', ['id' => $aboutId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $about = About::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $about->user);
        $this->assertEquals($user->id, $about->user->id);
    }
}
