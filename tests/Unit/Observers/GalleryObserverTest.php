<?php

namespace Tests\Unit\Observers;

use App\Models\Gallery;
use App\Models\Service;
use App\Observers\GalleryObserver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryObserverTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the Storage facade
        Storage::fake(config('filesystems.disks.STORAGE_DISK'));
        Storage::fake('gallery');
    }

    /** @test */
    public function it_is_registered_with_the_gallery_model()
    {
        // Check if the GalleryObserver is registered with the Gallery model
        $observers = Gallery::getObservers();

        $this->assertContains(GalleryObserver::class, $observers);
    }

    /** @test */
    public function it_deletes_removed_images_when_gallery_is_updated()
    {
        // Create a service for the gallery
        $service = Service::factory()->create();

        // Create a gallery with initial images
        $gallery = Gallery::factory()->create([
            'service_id' => $service->id,
            'image' => [],
        ]);

        // Create fake images and store them
        $image1 = UploadedFile::fake()->image('image1.jpg');
        $image2 = UploadedFile::fake()->image('image2.jpg');
        $image3 = UploadedFile::fake()->image('image3.jpg');

        $imagePath1 = $image1->hashName();
        $imagePath2 = $image2->hashName();
        $imagePath3 = $image3->hashName();

        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->putFileAs('', $image1, $imagePath1);
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->putFileAs('', $image2, $imagePath2);
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->putFileAs('', $image3, $imagePath3);

        // Update the gallery with the images
        $gallery->update(['image' => [$imagePath1, $imagePath2, $imagePath3]]);

        // Verify all images exist
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($imagePath1);
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($imagePath2);
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($imagePath3);

        // Update the gallery, removing one image
        $gallery->update(['image' => [$imagePath1, $imagePath3]]);

        // The observer should have deleted the removed image
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertMissing($imagePath2);

        // The remaining images should still exist
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($imagePath1);
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($imagePath3);
    }

    /** @test */
    public function it_deletes_all_images_when_gallery_is_deleted()
    {
        // Create a service for the gallery
        $service = Service::factory()->create();

        // Create a gallery with no initial images
        $gallery = Gallery::factory()->create([
            'service_id' => $service->id,
            'image' => [],
        ]);

        // Create fake images and store them
        $image1 = UploadedFile::fake()->image('image1.jpg');
        $image2 = UploadedFile::fake()->image('image2.jpg');

        $imagePath1 = $image1->hashName();
        $imagePath2 = $image2->hashName();

        Storage::disk('gallery')->putFileAs('', $image1, $imagePath1);
        Storage::disk('gallery')->putFileAs('', $image2, $imagePath2);

        // Update the gallery with the images
        $gallery->update(['image' => [$imagePath1, $imagePath2]]);

        // Verify all images exist
        Storage::disk('gallery')->assertExists($imagePath1);
        Storage::disk('gallery')->assertExists($imagePath2);

        // Delete the gallery
        $gallery->delete();

        // The observer should have deleted all images
        Storage::disk('gallery')->assertMissing($imagePath1);
        Storage::disk('gallery')->assertMissing($imagePath2);
    }
}
