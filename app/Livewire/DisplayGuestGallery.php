<?php

namespace App\Livewire;

use App\Models\PublicPage;
use App\Models\SectionColors;
use Illuminate\View\View;
use Livewire\Component;

class DisplayGuestGallery extends Component
{
    public function render(): View
    {
        return view('livewire.display-guest-gallery');
    }
}
