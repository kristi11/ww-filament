<?php

namespace Tests\Feature\Models;

use App\Models\User;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Lead;
use App\Models\Service;
use App\Models\Social;
use App\Models\Hero;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_user()
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
        ];

        $user = User::create($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['name'], $user->name);
        $this->assertEquals($userData['email'], $user->email);
        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
            'name' => $userData['name'],
        ]);
    }

    /** @test */
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $newData = [
            'name' => $this->faker->name,
        ];

        $user->update($newData);
        $user->refresh();

        $this->assertEquals($newData['name'], $user->name);
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();
        $userId = $user->id;

        $user->delete();

        $this->assertDatabaseMissing('users', ['id' => $userId]);
    }

    /** @test */
    public function it_has_addresses_relationship()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->addresses->contains($address));
        $this->assertInstanceOf(Address::class, $user->addresses->first());
    }

    /** @test */
    public function it_has_cart_relationship()
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Cart::class, $user->cart);
        $this->assertEquals($cart->id, $user->cart->id);
    }

    /** @test */
    public function it_has_orders_relationship()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->orders->contains($order));
        $this->assertInstanceOf(Order::class, $user->orders->first());
    }

    /** @test */
    public function it_has_leads_relationship()
    {
        $user = User::factory()->create();
        $lead = Lead::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->leads->contains($lead));
        $this->assertInstanceOf(Lead::class, $user->leads->first());
    }

    /** @test */
    public function it_has_services_relationship()
    {
        $user = User::factory()->create();
        $service = Service::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->services->contains($service));
        $this->assertInstanceOf(Service::class, $user->services->first());
    }

    /** @test */
    public function it_has_social_relationship()
    {
        $user = User::factory()->create();
        $social = Social::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Social::class, $user->social);
        $this->assertEquals($social->id, $user->social->id);
    }

    /** @test */
    public function it_has_hero_relationship()
    {
        $user = User::factory()->create();
        $hero = Hero::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Hero::class, $user->hero);
        $this->assertEquals($hero->id, $user->hero->id);
    }

    /** @test */
    public function it_has_filament_name_method()
    {
        $user = User::factory()->create([
            'name' => 'John Doe'
        ]);

        // Just test that the method exists and returns a string
        $this->assertIsString($user->getFilamentName());
    }
}
