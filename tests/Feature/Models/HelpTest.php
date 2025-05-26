<?php

namespace Tests\Feature\Models;

use App\Models\Help;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelpTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_help()
    {
        $user = User::factory()->create();

        $helpData = [
            'user_id' => $user->id,
            'content' => 'This is help content',
            'visibility' => true,
        ];

        $help = Help::create($helpData);

        $this->assertInstanceOf(Help::class, $help);
        $this->assertEquals($helpData['user_id'], $help->user_id);
        $this->assertEquals($helpData['content'], $help->content);
        $this->assertEquals($helpData['visibility'], $help->visibility);
        $this->assertDatabaseHas('helps', [
            'user_id' => $user->id,
            'content' => 'This is help content',
        ]);
    }

    /** @test */
    public function it_can_update_a_help()
    {
        $help = Help::factory()->create();

        $newData = [
            'content' => 'Updated help content',
            'visibility' => false,
        ];

        $help->update($newData);
        $help->refresh();

        $this->assertEquals($newData['content'], $help->content);
        $this->assertEquals($newData['visibility'], $help->visibility);
    }

    /** @test */
    public function it_can_delete_a_help()
    {
        $help = Help::factory()->create();
        $helpId = $help->id;

        $help->delete();

        $this->assertDatabaseMissing('helps', ['id' => $helpId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $help = Help::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $help->user);
        $this->assertEquals($user->id, $help->user->id);
    }
}
