<?php

namespace App\Livewire;

use App\Models\About;
use App\Models\Contact;
use Livewire\Component;

class FooterCompany extends Component
{
    public function render()
    {
        return view('livewire.footer-company',
        [
            'about' => About::first()->visibility,
            'contact' => Contact::first()->visibility,
        ]);
    }
}
