<?php

namespace App\Livewire;

use App\Models\PublicPage;
use Illuminate\View\View;
use Livewire\Component;

class DisplayGuestGallery extends Component
{
    public function render(): View
    {
        return view('livewire.display-guest-gallery',
        [
            'gallery' => PublicPage::where('gallery', true)->first(),
        ]);
    }
}
