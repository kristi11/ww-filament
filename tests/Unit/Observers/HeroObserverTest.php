<?php

namespace Tests\Unit\Observers;

use App\Models\Hero;
use App\Observers\HeroObserver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HeroObserverTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the Storage facade
        Storage::fake(config('filesystems.disks.STORAGE_DISK'));
    }

    /** @test */
    public function it_is_registered_with_the_hero_model()
    {
        // Check if the HeroObserver is registered with the Hero model
        $observers = Hero::getObservers();

        $this->assertContains(HeroObserver::class, $observers);
    }

    /** @test */
    public function it_deletes_old_image_when_hero_is_updated_with_new_image()
    {
        // Create a hero with an image
        $hero = Hero::factory()->create();

        // Create a fake image and store it
        $oldImage = UploadedFile::fake()->image('old-image.jpg');
        $oldImagePath = $oldImage->hashName();
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->putFileAs('', $oldImage, $oldImagePath);

        // Update the hero with the old image
        $hero->update(['image' => $oldImagePath]);

        // Verify the old image exists
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($oldImagePath);

        // Create a new fake image
        $newImage = UploadedFile::fake()->image('new-image.jpg');
        $newImagePath = $newImage->hashName();
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->putFileAs('', $newImage, $newImagePath);

        // Update the hero with the new image
        $hero->update(['image' => $newImagePath]);

        // The observer should have deleted the old image
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertMissing($oldImagePath);

        // The new image should still exist
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($newImagePath);
    }

    /** @test */
    public function it_deletes_image_when_hero_is_deleted()
    {
        // Create a hero with an image
        $hero = Hero::factory()->create();

        // Create a fake image and store it
        $image = UploadedFile::fake()->image('hero-image.jpg');
        $imagePath = $image->hashName();
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->putFileAs('', $image, $imagePath);

        // Update the hero with the image
        $hero->update(['image' => $imagePath]);

        // Verify the image exists
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($imagePath);

        // Delete the hero
        $hero->delete();

        // The observer should have deleted the image
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertMissing($imagePath);
    }
}
