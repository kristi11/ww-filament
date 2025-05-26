<?php

namespace Tests\Feature\Models;

use App\Models\Social;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SocialTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_social()
    {
        $user = User::factory()->create();

        $socialData = [
            'user_id' => $user->id,
            'facebook' => 'test.facebook',
            'instagram' => 'test.instagram',
            'twitter' => 'test.twitter',
            'linkedin' => 'test.linkedin',
        ];

        $social = Social::create($socialData);

        $this->assertInstanceOf(Social::class, $social);
        $this->assertEquals($socialData['user_id'], $social->user_id);
        $this->assertEquals($socialData['facebook'], $social->facebook);
        $this->assertEquals($socialData['instagram'], $social->instagram);
        $this->assertEquals($socialData['twitter'], $social->twitter);
        $this->assertEquals($socialData['linkedin'], $social->linkedin);
        $this->assertDatabaseHas('socials', [
            'user_id' => $user->id,
            'facebook' => 'test.facebook',
            'instagram' => 'test.instagram',
        ]);
    }

    /** @test */
    public function it_can_update_a_social()
    {
        $social = Social::factory()->create();

        $newData = [
            'facebook' => 'updated.facebook',
            'instagram' => 'updated.instagram',
            'twitter' => 'updated.twitter',
            'linkedin' => 'updated.linkedin',
        ];

        $social->update($newData);
        $social->refresh();

        $this->assertEquals($newData['facebook'], $social->facebook);
        $this->assertEquals($newData['instagram'], $social->instagram);
        $this->assertEquals($newData['twitter'], $social->twitter);
        $this->assertEquals($newData['linkedin'], $social->linkedin);
    }

    /** @test */
    public function it_can_delete_a_social()
    {
        $social = Social::factory()->create();
        $socialId = $social->id;

        $social->delete();

        $this->assertDatabaseMissing('socials', ['id' => $socialId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $social = Social::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $social->user);
        $this->assertEquals($user->id, $social->user->id);
    }
}
