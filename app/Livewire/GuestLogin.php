<?php

namespace App\Livewire;

use App\Models\Hero;
use App\Models\PublicPage;
use App\Models\SectionColors;
use Filament\Facades\Filament;
use Livewire\Component;

class GuestLogin extends Component
{
    public $customerPanelUrl;
    public $teamPanelUrl;
    public $adminPanelUrl;
    public function mount()
    {
        $this->customerPanelUrl = Filament::getPanel('customer')->getUrl();
        $this->teamPanelUrl = Filament::getPanel('team')->getUrl();
        $this->adminPanelUrl = Filament::getPanel('admin')->getUrl();
    }
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
        return view('livewire.guest-login', [
            'credentials' => PublicPage::where('credentials', true)->first(),
            'background' => SectionColors::first(),
        ]);
    }
}
