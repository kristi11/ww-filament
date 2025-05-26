<?php

namespace Tests\Feature\Models;

use App\Models\Support;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SupportTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_support()
    {
        $user = User::factory()->create();

        $supportData = [
            'user_id' => $user->id,
            'content' => 'This is support content',
        ];

        $support = Support::create($supportData);

        $this->assertInstanceOf(Support::class, $support);
        $this->assertEquals($supportData['user_id'], $support->user_id);
        $this->assertEquals($supportData['content'], $support->content);
        $this->assertDatabaseHas('supports', [
            'user_id' => $user->id,
            'content' => 'This is support content',
        ]);
    }

    /** @test */
    public function it_can_update_a_support()
    {
        $support = Support::factory()->create();

        $newData = [
            'content' => 'Updated support content',
        ];

        $support->update($newData);
        $support->refresh();

        $this->assertEquals($newData['content'], $support->content);
    }

    /** @test */
    public function it_can_delete_a_support()
    {
        $support = Support::factory()->create();
        $supportId = $support->id;

        $support->delete();

        $this->assertDatabaseMissing('supports', ['id' => $supportId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $support = Support::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $support->user);
        $this->assertEquals($user->id, $support->user->id);
    }
}
