<?php

/**
 * Observer class for the Hero model to handle lifecycle events.
 */

namespace App\Observers;

use /**
 * Hero Model.
 *
 * This model represents the Hero entity in the application.
 *
 * This model interacts with the 'heroes' table in the MySQL database
 * used by the application. It provides the relationship mappings,
 * attributes, and query scopes related to the Hero entity.
 *
 * The Hero model can also be a subject for queued operations since
 * the application uses the 'sync' queue connection.
 *
 * Note:
 * Ensure that any business logic or model manipulation adheres
 * to the project's coding and design standards.
 */
    App\Models\Hero;
use /**
 * Storage facade serves as a proxy to the underlying filesystem.
 * Provides methods for performing file storage operations such as
 * creating, retrieving, deleting, and modifying files within your application.
 *
 * This facade offers a simple way to interact with the filesystem,
 * allowing you to manage local, cloud-based, or other configured storage disks
 * with ease.
 *
 * Common use cases include saving user uploads, retrieving previously saved
 * data, and performing file manipulation operations.
 *
 * Usage of this facade requires the configuration of storage disks
 * within the `config/filesystems.php` file.
 */
    Illuminate\Support\Facades\Storage;

/**
 * Observes events on the Hero model and handles side effects accordingly.
 */
class HeroObserver
{
    /**
     * Handle the Hero "created" event.
     */
    public function created(Hero $hero): void
    {

    }

    /**
     * Handle the Hero "updated" event.
     */
    public function updated(Hero $hero): void
    {
        $originalImagePath = $hero->getOriginal('image');
        if ($hero->isDirty('image') && $originalImagePath !== null) {
            Storage::disk(config('filesystems.disks.STORAGE_DISK'))->delete($originalImagePath);
        }
    }

    /**
     * Handle the Hero "deleted" event.
     */
    public function deleted(Hero $hero): void
    {
        $originalImagePath = $hero->getOriginal('image');
        if ($originalImagePath !== null) {
            Storage::disk(config('filesystems.disks.STORAGE_DISK'))->delete($originalImagePath);
        }
    }

    /**
     * Handle the Hero "restored" event.
     */
    public function restored(Hero $hero): void
    {
        //
    }

    /**
     * Handle the Hero "force deleted" event.
     */
    public function forceDeleted(Hero $hero): void
    {
        //
    }
}
