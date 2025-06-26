<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class GuestCallToAction extends Component
{
    public function render(): View
    {
        return view('livewire.public.guest-call-to-action',
            [
                'admins' => cache()->remember('guest_call_to_action_admins', now()->addMinutes(60), function () {
                    return User::whereHas('roles', function ($query) {
                        $query->where('name', 'super_admin');
                    })->get();
                }),
            ]);
    }
}
