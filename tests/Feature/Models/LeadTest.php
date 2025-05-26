<?php

namespace Tests\Feature\Models;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeadTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_lead()
    {
        $user = User::factory()->create();

        $leadData = [
            'user_id' => $user->id,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'message' => $this->faker->paragraph,
            'read' => false,
            'status' => 'new',
            'has_new_reply' => false,
        ];

        $lead = Lead::create($leadData);

        $this->assertInstanceOf(Lead::class, $lead);
        $this->assertEquals($leadData['name'], $lead->name);
        $this->assertEquals($leadData['email'], $lead->email);
        $this->assertEquals($leadData['phone'], $lead->phone);
        $this->assertEquals($leadData['message'], $lead->message);
        $this->assertEquals($leadData['read'], $lead->read);
        $this->assertEquals($leadData['status'], $lead->status);
        $this->assertEquals($leadData['has_new_reply'], $lead->has_new_reply);
        $this->assertDatabaseHas('leads', [
            'user_id' => $user->id,
            'email' => $leadData['email'],
            'name' => $leadData['name'],
        ]);
    }

    /** @test */
    public function it_can_update_a_lead()
    {
        $lead = Lead::factory()->create();

        $newData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'read' => true,
            'status' => 'completed',
        ];

        $lead->update($newData);
        $lead->refresh();

        $this->assertEquals($newData['name'], $lead->name);
        $this->assertEquals($newData['email'], $lead->email);
        $this->assertEquals($newData['read'], $lead->read);
        $this->assertEquals($newData['status'], $lead->status);
    }

    /** @test */
    public function it_can_delete_a_lead()
    {
        $lead = Lead::factory()->create();
        $leadId = $lead->id;

        $lead->delete();

        $this->assertDatabaseMissing('leads', ['id' => $leadId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $lead = Lead::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $lead->user);
        $this->assertEquals($user->id, $lead->user->id);
    }

    /** @test */
    public function it_can_mark_as_read()
    {
        $lead = Lead::factory()->create(['read' => false]);

        $lead->update(['read' => true]);
        $lead->refresh();

        $this->assertTrue($lead->read);
    }

    /** @test */
    public function it_can_change_status()
    {
        $lead = Lead::factory()->create(['status' => 'new']);

        $lead->update(['status' => 'in_progress']);
        $lead->refresh();

        $this->assertEquals('in_progress', $lead->status);
    }
}
