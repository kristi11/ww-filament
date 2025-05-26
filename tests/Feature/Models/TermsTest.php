<?php

namespace Tests\Feature\Models;

use App\Models\Terms;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TermsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_terms()
    {
        $user = User::factory()->create();

        $termsData = [
            'user_id' => $user->id,
            'content' => 'This is terms content',
        ];

        $terms = Terms::create($termsData);

        $this->assertInstanceOf(Terms::class, $terms);
        $this->assertEquals($termsData['user_id'], $terms->user_id);
        $this->assertEquals($termsData['content'], $terms->content);
        $this->assertDatabaseHas('terms', [
            'user_id' => $user->id,
            'content' => 'This is terms content',
        ]);
    }

    /** @test */
    public function it_can_update_a_terms()
    {
        $terms = Terms::factory()->create();

        $newData = [
            'content' => 'Updated terms content',
        ];

        $terms->update($newData);
        $terms->refresh();

        $this->assertEquals($newData['content'], $terms->content);
    }

    /** @test */
    public function it_can_delete_a_terms()
    {
        $terms = Terms::factory()->create();
        $termsId = $terms->id;

        $terms->delete();

        $this->assertDatabaseMissing('terms', ['id' => $termsId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $terms = Terms::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $terms->user);
        $this->assertEquals($user->id, $terms->user->id);
    }
}
