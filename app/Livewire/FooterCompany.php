<?php

namespace App\Livewire;

use App\Models\About;
use App\Models\Contact;
use App\Models\Hero;
use Livewire\Component;

class FooterCompany extends Component
{
    public function render()
    {
        return view('livewire.footer-company',
        [
            'about' => cache()->remember('footer_company_about', now()->addMinutes(60), function () {
                return About::first()->visibility;
            }),
            'contact' => cache()->remember('footer_company_contact', now()->addMinutes(60), function () {
                return Contact::first()->visibility;
            }),
        ]);
    }
}
