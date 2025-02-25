<?php

namespace App\Livewire;

use App\Models\PublicPage;
use Livewire\Component;

class GradientNav extends Component
{
    public function render()
    {
        return view('livewire.public.gradient-nav',
            [
                'shop' => PublicPage::where('shop', true)->first(),
                'services' => PublicPage::where('services', true)->first(),
                'hours' => PublicPage::where('hours', true)->first(),
                'email' => PublicPage::where('email', true)->first(),
            ]);
    }
}
