<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class SecureMailto extends Component
{
    public $email;

    public function redirectToMailto()
    {
        $encodedEmail = urlencode($this->email);
        $mailtoLink = "mailto:$encodedEmail";

        return redirect()->to($mailtoLink);
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.secure-mailto');
    }
}
