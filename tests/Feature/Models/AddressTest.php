<?php

namespace Tests\Feature\Models;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_an_address()
    {
        $user = User::factory()->create();

        $addressData = [
            'user_id' => $user->id,
            'street' => $this->faker->streetName,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
        ];

        $address = Address::create($addressData);

        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals($addressData['street'], $address->street);
        $this->assertEquals($addressData['city'], $address->city);
        $this->assertEquals($addressData['state'], $address->state);
        $this->assertEquals($addressData['zip'], $address->zip);
        $this->assertDatabaseHas('addresses', [
            'user_id' => $user->id,
            'street' => $addressData['street'],
            'city' => $addressData['city'],
        ]);
    }

    /** @test */
    public function it_can_update_an_address()
    {
        $address = Address::factory()->create();

        $newData = [
            'street' => $this->faker->streetName,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
        ];

        $address->update($newData);
        $address->refresh();

        $this->assertEquals($newData['street'], $address->street);
        $this->assertEquals($newData['city'], $address->city);
        $this->assertEquals($newData['state'], $address->state);
        $this->assertEquals($newData['zip'], $address->zip);
    }

    /** @test */
    public function it_can_delete_an_address()
    {
        $address = Address::factory()->create();
        $addressId = $address->id;

        $address->delete();

        $this->assertDatabaseMissing('addresses', ['id' => $addressId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $address->user);
        $this->assertEquals($user->id, $address->user->id);
    }
}
