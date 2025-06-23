<?php

namespace Tests\Unit\Actions\Leads;

use App\Actions\Leads\CreateLeadFromForm;
use App\Mail\LeadNotification;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CreateLeadFromFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
    }

    /** @test */
    public function it_returns_null_when_no_super_admin_is_found()
    {
        // Arrange
        $action = new CreateLeadFromForm();
        $formData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'message' => 'Test message',
        ];

        // Act
        $result = $action->execute($formData);

        // Assert
        $this->assertNull($result);
        $this->assertDatabaseMissing('leads', ['email' => 'john@example.com']);
        Mail::assertNothingSent();
    }

    /** @test */
    public function it_creates_lead_and_sends_notification_when_super_admin_exists()
    {
        // Arrange
        $admin = User::factory()->create();
        $admin->assignRole('super_admin');

        $action = new CreateLeadFromForm();
        $formData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'message' => 'Test message',
        ];

        // Act
        $result = $action->execute($formData);

        // Assert
        $this->assertInstanceOf(Lead::class, $result);
        $this->assertEquals('john@example.com', $result->email);
        $this->assertEquals($admin->id, $result->user_id);
        $this->assertEquals('new', $result->status);
        $this->assertFalse($result->has_new_reply);

        $this->assertDatabaseHas('leads', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'message' => 'Test message',
            'user_id' => $admin->id,
        ]);

        Mail::assertSent(LeadNotification::class, function ($mail) use ($admin, $result) {
            return $mail->hasTo($admin->email) && $mail->lead->id === $result->id;
        });
    }
}
