<?php

namespace App\Observers;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

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
                    if (!in_array($originalImage, $updatedImages)) {
                        Storage::disk('DO-SPACES')->delete($originalImage);
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
