<?php

namespace Tests\Unit\Observers;

use App\Models\Product;
use App\Observers\ProductsObserver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductsObserverTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the Storage facade
        Storage::fake(config('filesystems.disks.STORAGE_DISK'));
    }

    /** @test */
    public function it_is_registered_with_the_product_model()
    {
        // Check if the ProductsObserver is registered with the Product model
        $observers = Product::getObservers();

        $this->assertContains(ProductsObserver::class, $observers);
    }

    /** @test */
    public function it_deletes_removed_images_when_product_is_updated()
    {
        // Create a product with initial images
        $product = Product::factory()->create([
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

        // Update the product with the images
        $product->update(['image' => [$imagePath1, $imagePath2, $imagePath3]]);

        // Verify all images exist
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($imagePath1);
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($imagePath2);
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($imagePath3);

        // Update the product, removing one image
        $product->update(['image' => [$imagePath1, $imagePath3]]);

        // The observer should have deleted the removed image
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertMissing($imagePath2);

        // The remaining images should still exist
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($imagePath1);
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($imagePath3);
    }

    /** @test */
    public function it_deletes_all_images_when_product_is_deleted()
    {
        // Create a product with no initial images
        $product = Product::factory()->create([
            'image' => [],
        ]);

        // Create fake images and store them
        $image1 = UploadedFile::fake()->image('image1.jpg');
        $image2 = UploadedFile::fake()->image('image2.jpg');

        $imagePath1 = $image1->hashName();
        $imagePath2 = $image2->hashName();

        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->putFileAs('', $image1, $imagePath1);
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->putFileAs('', $image2, $imagePath2);

        // Update the product with the images
        $product->update(['image' => [$imagePath1, $imagePath2]]);

        // Verify all images exist
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($imagePath1);
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertExists($imagePath2);

        // Delete the product
        $product->delete();

        // The observer should have deleted all images
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertMissing($imagePath1);
        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->assertMissing($imagePath2);
    }
}
