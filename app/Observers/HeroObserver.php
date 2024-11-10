<?php

namespace App\Observers;

use App\Models\Hero;
use Illuminate\Support\Facades\Storage;

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
        if ($hero->isDirty('image') && $originalImagePath !== null) {
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
