<?php

namespace App\Livewire;

use App\Models\Social;
use Livewire\Component;

class DisplaySocials extends Component
{
    public function socials(): Social
    {
        return Social::first();
    }

    public function instagram()
    {
        return redirect(url('https://www.instagram.com/'.$this->socials()->instagram));
    }

    public function facebook()
    {
        return redirect(url('https://www.facebook.com/'.$this->socials()->facebook));
    }

    public function linkedin()
    {
        return redirect(url('https://www.linkedin.com/in/'.$this->socials()->linkedin));
    }

    public function twitter()
    {
        return redirect(url('https://twitter.com/'.$this->socials()->twitter));
    }
    public function render()
    {
        return view('livewire.display-socials',
        [
            'socials' => Social::first()
        ]);
    }
}
