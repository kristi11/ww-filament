<?php

namespace App\Actions\Heroes;

use App\Models\Hero;
use App\Models\PublicPage;

class GetHeroData
{
    /**
     * Get the hero data and determine if it should be displayed publicly
     *
     * @return array Array containing the hero model and a boolean indicating if it should be displayed publicly
     */
    public function execute(): array
    {
        // Get the first hero from the database
        $hero = Hero::first();

        // Check if the hero should be displayed publicly
        // Get the first PublicPage record and check its hero column
        $publicHero = PublicPage::first()?->hero ?? true; // Default to true if no record exists

        return [
            'hero' => $hero,
            'publicHero' => $publicHero,
        ];
    }
}
