<?php

namespace App\Livewire;

use App\Actions\Heroes\GetHeroData;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class GuestHero extends Component
{
    public $image = '';

    public function render(GetHeroData $getHeroData): View
    {
        $data = $getHeroData->execute();

        return view('livewire.public.guest-hero', [
            'hero' => $data['hero'],
            'publicHero' => $data['publicHero'],
        ]);
    }
}
