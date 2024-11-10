<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductsObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if ($product->isDirty('image')) {
            $originalImages = $product->getOriginal('image');
            $updatedImages = $product->image;

            if ($originalImages !== null) {
                // Loop through original images and delete any that don't exist in the updated images
                foreach ($originalImages as $originalImage) {
                    if (!in_array($originalImage, $updatedImages)) {
                        Storage::disk(config('filesystems.disks.STORAGE_DISK'))->delete($originalImage);
                    }
                }
            }
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $images = $product->getOriginal('image'); // gets the 'image' attribute as an array

        if ($images !== null) {
            // Loop through images and delete each from storage
            foreach ($images as $image) {
                Storage::disk(config('filesystems.disks.STORAGE_DISK'))->delete($image);
            }
        }
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
