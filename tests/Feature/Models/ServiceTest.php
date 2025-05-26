<?php

namespace Tests\Feature\Models;

use App\Models\Appointment;
use App\Models\Flexibility;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_service()
    {
        $user = User::factory()->create();

        $serviceData = [
            'user_id' => $user->id,
            'name' => 'Test Service',
            'description' => 'This is a test service',
            'price' => 100,
            'estimated_hours' => 2,
            'estimated_minutes' => 30,
            'extra_description' => 'Extra details about the service',
        ];

        $service = Service::create($serviceData);

        $this->assertInstanceOf(Service::class, $service);
        $this->assertEquals($serviceData['user_id'], $service->user_id);
        $this->assertEquals($serviceData['name'], $service->name);
        $this->assertEquals($serviceData['description'], $service->description);
        $this->assertEquals($serviceData['price'], $service->price);
        $this->assertEquals($serviceData['estimated_hours'], $service->estimated_hours);
        $this->assertEquals($serviceData['estimated_minutes'], $service->estimated_minutes);
        $this->assertEquals($serviceData['extra_description'], $service->extra_description);
        $this->assertDatabaseHas('services', [
            'user_id' => $user->id,
            'name' => 'Test Service',
        ]);
    }

    /** @test */
    public function it_can_update_a_service()
    {
        $service = Service::factory()->create();

        $newData = [
            'name' => 'Updated Service',
            'price' => 150,
        ];

        $service->update($newData);
        $service->refresh();

        $this->assertEquals($newData['name'], $service->name);
        $this->assertEquals($newData['price'], $service->price);
    }

    /** @test */
    public function it_can_delete_a_service()
    {
        $service = Service::factory()->create();
        $serviceId = $service->id;

        $service->delete();

        $this->assertDatabaseMissing('services', ['id' => $serviceId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $service = Service::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $service->user);
        $this->assertEquals($user->id, $service->user->id);
    }

    /** @test */
    public function it_has_many_galleries()
    {
        $service = Service::factory()->create();
        $gallery = Gallery::factory()->create(['service_id' => $service->id]);

        $this->assertInstanceOf(Gallery::class, $service->galleries->first());
        $this->assertEquals($gallery->id, $service->galleries->first()->id);
    }

    /** @test */
    public function it_has_many_appointments()
    {
        $service = Service::factory()->create();
        $appointment = Appointment::factory()->create(['service_id' => $service->id]);

        $this->assertInstanceOf(Appointment::class, $service->appointments->first());
        $this->assertEquals($appointment->id, $service->appointments->first()->id);
    }

    /** @test */
    public function it_has_display_price_with_flexible_pricing()
    {
        $user = User::factory()->create();
        Flexibility::create([
            'user_id' => $user->id,
            'flexible_pricing' => true,
        ]);

        $service = Service::factory()->create([
            'user_id' => $user->id,
            'price' => 100,
        ]);

        $this->assertEquals('Price starting at $100', $service->display_price);
    }

    /** @test */
    public function it_has_display_price_without_flexible_pricing()
    {
        $user = User::factory()->create();
        Flexibility::create([
            'user_id' => $user->id,
            'flexible_pricing' => false,
        ]);

        $service = Service::factory()->create([
            'user_id' => $user->id,
            'price' => 100,
        ]);

        $this->assertEquals(100, $service->display_price);
    }
}
