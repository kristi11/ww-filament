<?php

namespace Tests\Feature\Models;

use App\Models\Privacy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PrivacyTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_privacy()
    {
        $user = User::factory()->create();

        $privacyData = [
            'user_id' => $user->id,
            'content' => 'This is privacy content',
            'visibility' => true,
        ];

        $privacy = Privacy::create($privacyData);

        $this->assertInstanceOf(Privacy::class, $privacy);
        $this->assertEquals($privacyData['user_id'], $privacy->user_id);
        $this->assertEquals($privacyData['content'], $privacy->content);
        $this->assertEquals($privacyData['visibility'], $privacy->visibility);
        $this->assertDatabaseHas('privacies', [
            'user_id' => $user->id,
            'content' => 'This is privacy content',
        ]);
    }

    /** @test */
    public function it_can_update_a_privacy()
    {
        $privacy = Privacy::factory()->create();

        $newData = [
            'content' => 'Updated privacy content',
            'visibility' => false,
        ];

        $privacy->update($newData);
        $privacy->refresh();

        $this->assertEquals($newData['content'], $privacy->content);
        $this->assertEquals($newData['visibility'], $privacy->visibility);
    }

    /** @test */
    public function it_can_delete_a_privacy()
    {
        $privacy = Privacy::factory()->create();
        $privacyId = $privacy->id;

        $privacy->delete();

        $this->assertDatabaseMissing('privacies', ['id' => $privacyId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $privacy = Privacy::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $privacy->user);
        $this->assertEquals($user->id, $privacy->user->id);
    }
}
