<?php

namespace App\Actions\Footer;

use App\Models\Hero;
use App\Models\Social;
use Illuminate\Support\Facades\Cache;

class GetFooterSocialsData
{
    /**
     * Get data for footer social links
     *
     * @return array Array containing social media data and hero color data
     */
    public function execute(): array
    {
        return [
            'social' => $this->getSocialData(),
            'hero' => $this->getHeroData(),
        ];
    }

    /**
     * Get social media data
     *
     * @return Social|null
     */
    protected function getSocialData(): ?Social
    {
        return Cache::remember('footer_socials_data', now()->addMinutes(60), function () {
            return Social::first();
        });
    }

    /**
     * Get hero data for color styling
     *
     * @return Hero|null
     */
    protected function getHeroData(): ?Hero
    {
        return Cache::remember('footer_socials_hero', now()->addMinutes(60), function () {
            return Hero::first();
        });
    }
}
