<?php

namespace App\Actions\Footer;

use App\Models\Hero;
use App\Models\PublicPage;
use App\Models\SectionColors;
use App\Models\Social;
use Illuminate\Support\Facades\Cache;

class GetFooterData
{
    /**
     * Get all data needed for the footer
     *
     * @return array Array containing hero, background, social, and footer visibility data
     */
    public function execute(): array
    {
        return [
            'hero' => $this->getHero(),
            'background' => $this->getBackground(),
            'social' => $this->getSocial(),
            'footer' => $this->getFooterVisibility(),
        ];
    }

    /**
     * Get the hero model for brand colors
     *
     * @return Hero|null
     */
    protected function getHero(): ?Hero
    {
        return Cache::remember('footer_hero', now()->addMinutes(60), function () {
            return Hero::first();
        });
    }

    /**
     * Get the section colors model for background colors
     *
     * @return SectionColors|null
     */
    protected function getBackground(): ?SectionColors
    {
        return Cache::remember('footer_background', now()->addMinutes(60), function () {
            return SectionColors::first();
        });
    }

    /**
     * Get the social model for social media links
     *
     * @return Social|null
     */
    protected function getSocial(): ?Social
    {
        return Cache::remember('footer_social', now()->addMinutes(60), function () {
            return Social::first();
        });
    }

    /**
     * Check if the footer should be displayed
     *
     * @return PublicPage|null
     */
    protected function getFooterVisibility(): ?PublicPage
    {
        return Cache::remember('footer_visibility', now()->addMinutes(60), function () {
            return PublicPage::where('footer', true)->first();
        });
    }
}
