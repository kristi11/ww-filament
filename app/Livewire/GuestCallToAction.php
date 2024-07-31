<?php

namespace App\Livewire;

use App\Models\Hero;
use App\Models\PublicPage;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class GuestCallToAction extends Component
{
    public function render(): View
    {
        return view('livewire.public.guest-call-to-action',
            [
                'admins' => User::whereHas('roles', function ($query) {
                    $query->where('name', 'super_admin');
                })->get(),
                'hero' => Hero::firstOrFail(),
                'email' => PublicPage::where('email', true)->first(),
            ]);
    }
}
