<?php

namespace App\Livewire;

use App\Models\PublicPage;
use App\Models\SectionColors;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class GuestFooter extends Component
{
    public function render(): View
    {
        return view('livewire.public.guest-footer',
        [
            'footer' => PublicPage::where('footer', true)->first(),
            'background' => SectionColors::first(),
        ]);
    }
}
