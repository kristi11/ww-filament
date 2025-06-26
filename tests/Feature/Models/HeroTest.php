<?php

namespace Tests\Feature\Models;

use App\Models\Hero;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HeroTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the Storage facade
        Storage::fake(config('filesystems.disks.STORAGE_DISK'));
    }

    /** @test */
    public function it_can_create_a_hero()
    {
        $user = User::factory()->create();

        $heroData = [
            'user_id' => $user->id,
            'mainQuote' => 'Test Main Quote',
            'secondaryQuote' => 'Test Secondary Quote',
            'thirdQuote' => 'Test Third Quote',
            'gradientType' => 'linear-gradient',
            'gradientDegree' => '90',
            'gradientDegreeStart' => '0',
            'gradientDegreeEnd' => '100',
            'gradientDegreeFirstColor' => '#0061ff',
            'gradientDegreeSecondColor' => '#60efff',
            'waves' => true,
            'full_screen_image' => true,
        ];

        $hero = Hero::create($heroData);

        $this->assertInstanceOf(Hero::class, $hero);
        $this->assertEquals($heroData['user_id'], $hero->user_id);
        $this->assertEquals($heroData['mainQuote'], $hero->mainQuote);
        $this->assertEquals($heroData['secondaryQuote'], $hero->secondaryQuote);
        $this->assertEquals($heroData['thirdQuote'], $hero->thirdQuote);
        $this->assertEquals($heroData['gradientType'], $hero->gradientType);
        $this->assertEquals($heroData['gradientDegree'], $hero->gradientDegree);
        $this->assertEquals($heroData['gradientDegreeStart'], $hero->gradientDegreeStart);
        $this->assertEquals($heroData['gradientDegreeEnd'], $hero->gradientDegreeEnd);
        $this->assertEquals($heroData['gradientDegreeFirstColor'], $hero->gradientDegreeFirstColor);
        $this->assertEquals($heroData['gradientDegreeSecondColor'], $hero->gradientDegreeSecondColor);
        $this->assertEquals($heroData['waves'], $hero->waves);
        $this->assertEquals($heroData['full_screen_image'], $hero->full_screen_image);
        $this->assertDatabaseHas('heroes', [
            'user_id' => $user->id,
            'mainQuote' => 'Test Main Quote',
        ]);
    }

    /** @test */
    public function it_can_upload_an_image()
    {
        $user = User::factory()->create();

        $heroData = [
            'user_id' => $user->id,
            'mainQuote' => 'Test Main Quote',
            'secondaryQuote' => 'Test Secondary Quote',
            'thirdQuote' => 'Test Third Quote',
            'gradientType' => 'linear-gradient',
            'gradientDegree' => '90',
            'gradientDegreeStart' => '0',
            'gradientDegreeEnd' => '100',
            'gradientDegreeFirstColor' => '#0061ff',
            'gradientDegreeSecondColor' => '#60efff',
            'waves' => true,
            'full_screen_image' => true,
        ];

        $hero = Hero::create($heroData);

        // Create a fake image
        $file = UploadedFile::fake()->image('hero-image.jpg');

        // Update the hero with the image
        $hero->update(['image' => $file->hashName()]);

        // Store the file in the storage
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->putFileAs('hero', $file, $file->hashName());

        // Assert the file exists in storage
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists('hero/'.$file->hashName());

        // Assert the hero has the image path
        $this->assertEquals($file->hashName(), $hero->image);
    }

    /** @test */
    public function it_can_update_a_hero()
    {
        $hero = Hero::factory()->create();

        $newData = [
            'mainQuote' => 'Updated Main Quote',
            'secondaryQuote' => 'Updated Secondary Quote',
            'gradientType' => 'radial-gradient',
            'waves' => false,
        ];

        $hero->update($newData);
        $hero->refresh();

        $this->assertEquals($newData['mainQuote'], $hero->mainQuote);
        $this->assertEquals($newData['secondaryQuote'], $hero->secondaryQuote);
        $this->assertEquals($newData['gradientType'], $hero->gradientType);
        $this->assertEquals($newData['waves'], $hero->waves);
    }

    /** @test */
    public function it_can_delete_a_hero()
    {
        $hero = Hero::factory()->create();
        $heroId = $hero->id;

        $hero->delete();

        $this->assertDatabaseMissing('heroes', ['id' => $heroId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $hero = Hero::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $hero->user);
        $this->assertEquals($user->id, $hero->user->id);
    }
}
