<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class GuestContent extends Component
{
    use WithPagination;

    public function render(): Factory|View|Application
    {
        return view('livewire.public.guest_content');
    }
}
