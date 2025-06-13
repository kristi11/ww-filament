<?php

namespace App\Livewire;

use App\Models\PublicPage;
use App\Models\SectionPosition;
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
        // Get section positions from the database, ordered by position
        $sectionPositions = SectionPosition::where('is_visible', true)
            ->orderBy('position')
            ->get()
            ->pluck('section_name')
            ->toArray();

        // If no positions are defined, use the default order
        if (empty($sectionPositions)) {
            $sectionPositions = [
                'display-socials',
                'guest-login',
                'display-guest-services',
                'guest-shop-display',
                'display-guest-business-hours',
                'display-guest-gallery',
            ];
        }

        return view('livewire.public.guest_content', [
            'sectionPositions' => $sectionPositions,
        ]);
    }
}
