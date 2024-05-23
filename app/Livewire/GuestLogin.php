<?php

namespace App\Livewire;

use Livewire\Component;

class GuestLogin extends Component
{
    public function loginAsCustomer()
    {
        return redirect(url('dashboard/login'));
    }

    public function loginAsTeam()
    {
        return redirect(url('team/login'));
    }

    public function loginAsSuperAdmin()
    {
        return redirect(url('admin/login'));
    }

    public function render()
    {
        return view('livewire.guest-login');
    }
}
