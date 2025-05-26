<?php

namespace Tests\Feature\Models;

use App\Models\Flexibility;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlexibilityTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_flexibility()
    {
        $user = User::factory()->create();

        $flexibilityData = [
            'user_id' => $user->id,
            'always_open' => true,
            'flexible_pricing' => true,
        ];

        $flexibility = Flexibility::create($flexibilityData);

        $this->assertInstanceOf(Flexibility::class, $flexibility);
        $this->assertEquals($flexibilityData['user_id'], $flexibility->user_id);
        $this->assertEquals($flexibilityData['always_open'], $flexibility->always_open);
        $this->assertEquals($flexibilityData['flexible_pricing'], $flexibility->flexible_pricing);
        $this->assertDatabaseHas('flexibilities', [
            'user_id' => $user->id,
            'always_open' => true,
            'flexible_pricing' => true,
        ]);
    }

    /** @test */
    public function it_can_update_a_flexibility()
    {
        $user = User::factory()->create();
        $flexibility = Flexibility::create([
            'user_id' => $user->id,
            'always_open' => false,
            'flexible_pricing' => false,
        ]);

        $newData = [
            'always_open' => true,
            'flexible_pricing' => true,
        ];

        $flexibility->update($newData);
        $flexibility->refresh();

        $this->assertEquals($newData['always_open'], $flexibility->always_open);
        $this->assertEquals($newData['flexible_pricing'], $flexibility->flexible_pricing);
    }

    /** @test */
    public function it_can_delete_a_flexibility()
    {
        $user = User::factory()->create();
        $flexibility = Flexibility::create([
            'user_id' => $user->id,
            'always_open' => false,
            'flexible_pricing' => false,
        ]);
        $flexibilityId = $flexibility->id;

        $flexibility->delete();

        $this->assertDatabaseMissing('flexibilities', ['id' => $flexibilityId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $flexibility = Flexibility::create([
            'user_id' => $user->id,
            'always_open' => false,
            'flexible_pricing' => false,
        ]);

        $this->assertInstanceOf(User::class, $flexibility->user);
        $this->assertEquals($user->id, $flexibility->user->id);
    }
}
