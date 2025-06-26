<?php

/**
 * Observer class for the Gallery model.
 * Handles the lifecycle events of the Gallery instance, such as created, updated, deleted, restored,
 * and force deleted. Provides logic for corresponding events, such as cleaning up associated resources.
 */

namespace App\Observers;

use /**
 * The Gallery model represents a database record in the 'galleries' table.
 *
 * This model is part of a Laravel application using MySQL as the database backend
 * and operates within a queue connection set to 'sync'. It serves as a central
 * structure for handling and managing galleries-related data.
 *
 * Functionalities associated with this model might include relationships,
 * accessors, mutators, and query scopes to facilitate interaction with the
 * application and database.
 *
 * Note: Ensure that the database table schema and associated relationships
 * are compatible with the current configuration and Laravel version.
 */
App\Models\Gallery;
use /**
 * Class Storage
 *
 * A facade for accessing Laravel's filesystem storage functionality.
 * Provides an expressive, fluent interface for interacting with files.
 * Allows handling files on local or cloud storage systems.
 *
 * Common functionalities include:
 * - Reading and writing files.
 * - Deleting files and directories.
 * - Checking file or directory existence.
 * - File metadata and management.
 * - Configurable cloud storage integration.
 *
 * This class interacts with the underlying filesystem implementation
 * defined by your application's configuration.
 *
 * @see \Illuminate\Contracts\Filesystem\Factory
 * @see \Illuminate\Contracts\Filesystem\Filesystem
 */
Illuminate\Support\Facades\Storage;

/**
 * Observes model events for the Gallery model.
 */
class GalleryObserver
{
    /**
     * Handle the Gallery "created" event.
     */
    public function created(Gallery $gallery): void
    {
        //
    }

    /**
     * Handle the Gallery "updated" event.
     */
    public function updated(Gallery $gallery): void
    {
        if ($gallery->isDirty('image')) {
            $originalImages = $gallery->getOriginal('image');
            $updatedImages = $gallery->image;

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
     * Handle the Gallery "deleted" event.
     */
    public function deleted(Gallery $gallery): void
    {
        $images = $gallery->getOriginal('image'); // gets the 'image' attribute as an array

        if ($images !== null) {
            // Loop through images and delete each from storage
            foreach ($images as $image) {
                Storage::disk('gallery')->delete($image);
            }
        }
    }

    /**
     * Handle the Gallery "restored" event.
     */
    public function restored(Gallery $gallery): void
    {
        //
    }

    /**
     * Handle the Gallery "force deleted" event.
     */
    public function forceDeleted(Gallery $gallery): void
    {
        //
    }
}
