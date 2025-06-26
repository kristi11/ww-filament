<?php

namespace Tests\Feature\Models;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use App\Observers\AppointmentObserver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Disable notifications during testing
        Notification::fake();

        // Disable the AppointmentObserver during testing
        Appointment::flushEventListeners();
    }

    /** @test */
    public function it_can_create_an_appointment()
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();
        $teamUser = User::factory()->create();

        $appointmentData = [
            'user_id' => $user->id,
            'service_id' => $service->id,
            'teamUser_id' => $teamUser->id,
            'date' => '2023-06-15',
            'time' => '14:30',
            'client_name' => 'John Doe',
            'client_email' => 'john@example.com',
            'client_phone' => '123-456-7890',
            'client_referer' => 'Website',
            'notes' => 'Some notes about the appointment',
            'status' => AppointmentStatus::Pending->value,
        ];

        $appointment = Appointment::create($appointmentData);

        $this->assertInstanceOf(Appointment::class, $appointment);
        $this->assertEquals($appointmentData['user_id'], $appointment->user_id);
        $this->assertEquals($appointmentData['service_id'], $appointment->service_id);
        $this->assertEquals($appointmentData['teamUser_id'], $appointment->teamUser_id);
        $this->assertEquals($appointmentData['date'], $appointment->date);
        $this->assertEquals($appointmentData['time'], $appointment->time);
        $this->assertEquals($appointmentData['client_name'], $appointment->client_name);
        $this->assertEquals($appointmentData['client_email'], $appointment->client_email);
        $this->assertEquals($appointmentData['client_phone'], $appointment->client_phone);
        $this->assertEquals($appointmentData['client_referer'], $appointment->client_referer);
        $this->assertEquals($appointmentData['notes'], $appointment->notes);
        $this->assertEquals($appointmentData['status'], $appointment->status);
        $this->assertDatabaseHas('appointments', [
            'user_id' => $user->id,
            'service_id' => $service->id,
            'client_name' => 'John Doe',
        ]);
    }

    /** @test */
    public function it_can_update_an_appointment()
    {
        $appointment = Appointment::factory()->create([
            'status' => AppointmentStatus::Pending->value,
        ]);

        $newData = [
            'date' => '2023-07-20',
            'time' => '16:00',
            'status' => AppointmentStatus::Confirmed->value,
        ];

        $appointment->update($newData);
        $appointment->refresh();

        $this->assertEquals($newData['date'], $appointment->date);
        $this->assertEquals($newData['time'], $appointment->time);
        $this->assertEquals($newData['status'], $appointment->status);
    }

    /** @test */
    public function it_can_delete_an_appointment()
    {
        $appointment = Appointment::factory()->create();
        $appointmentId = $appointment->id;

        $appointment->delete();

        $this->assertDatabaseMissing('appointments', ['id' => $appointmentId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $appointment = Appointment::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $appointment->user);
        $this->assertEquals($user->id, $appointment->user->id);
    }

    /** @test */
    public function it_belongs_to_a_service()
    {
        $service = Service::factory()->create();
        $appointment = Appointment::factory()->create(['service_id' => $service->id]);

        $this->assertInstanceOf(Service::class, $appointment->service);
        $this->assertEquals($service->id, $appointment->service->id);
    }

    /** @test */
    public function it_belongs_to_a_team_user()
    {
        $teamUser = User::factory()->create();
        $appointment = Appointment::factory()->create(['teamUser_id' => $teamUser->id]);

        $this->assertInstanceOf(User::class, $appointment->teamUser);
        $this->assertEquals($teamUser->id, $appointment->teamUser->id);
    }
}
