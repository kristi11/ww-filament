<?php

/**
 * This observer handles events related to the Product model.
 */

namespace App\Observers;

use /**
 * Represents the Product model in the Laravel application.
 *
 * This model interacts with the `products` table in the MySQL database.
 *
 * The Product model may contain business logic, relationships, and
 * other functionalities specific to the product entity.
 *
 * Queue connection for operations is set to "sync".
 */
App\Models\Product;
use /**
 * The Storage facade provides methods to interact with the file storage system in Laravel.
 * It offers a simplified interface to manage files, including reading, writing, and deleting files,
 * as well as manipulating directories and managing file metadata.
 *
 * Laravel supports multiple storage drivers like local, S3, FTP, and others,
 * which can be set in the configuration file.
 *
 * Common usage includes:
 * - Managing file uploads.
 * - Accessing stored files.
 * - Generating file URLs.
 * - Performing file operations such as copying, deleting, and renaming.
 *
 * This facade is part of Laravel's service container and must be appropriately configured
 * in the application's `filesystem.php` configuration file.
 *
 * To use a specific storage disk, you can specify it in the method calls or
 * set the default disk in the configuration.
 */
Illuminate\Support\Facades\Storage;

/**
 * Observes the lifecycle events of the Product model and performs specific actions
 * based on the type of event triggered.
 */
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
                    if (! in_array($originalImage, $updatedImages)) {
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
