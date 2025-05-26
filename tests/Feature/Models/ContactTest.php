<?php

namespace Tests\Feature\Models;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_contact()
    {
        $user = User::factory()->create();

        $contactData = [
            'user_id' => $user->id,
            'content' => 'This is contact content',
            'visibility' => true,
        ];

        $contact = Contact::create($contactData);

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertEquals($contactData['user_id'], $contact->user_id);
        $this->assertEquals($contactData['content'], $contact->content);
        $this->assertEquals($contactData['visibility'], $contact->visibility);
        $this->assertDatabaseHas('contacts', [
            'user_id' => $user->id,
            'content' => 'This is contact content',
        ]);
    }

    /** @test */
    public function it_can_update_a_contact()
    {
        $contact = Contact::factory()->create();

        $newData = [
            'content' => 'Updated contact content',
            'visibility' => false,
        ];

        $contact->update($newData);
        $contact->refresh();

        $this->assertEquals($newData['content'], $contact->content);
        $this->assertEquals($newData['visibility'], $contact->visibility);
    }

    /** @test */
    public function it_can_delete_a_contact()
    {
        $contact = Contact::factory()->create();
        $contactId = $contact->id;

        $contact->delete();

        $this->assertDatabaseMissing('contacts', ['id' => $contactId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $contact->user);
        $this->assertEquals($user->id, $contact->user->id);
    }
}
