<?php

namespace App\Actions\Socials;

use App\Models\Social;
use Illuminate\Support\Facades\Cache;

class RedirectToSocialMedia
{
    /**
     * Get social data from cache or database
     *
     * @return Social|null
     */
    protected function getSocialData(): ?Social
    {
        return Cache::remember('social_data', now()->addMinutes(60), function () {
            return Social::first();
        });
    }

    /**
     * Redirect to a social media platform
     *
     * @param string $platform The social media platform (instagram, facebook, linkedin, twitter)
     * @return string|null The URL to redirect to, or null if the platform is not available
     */
    public function execute(string $platform): ?string
    {
        $socialData = $this->getSocialData();

        if (!$socialData) {
            return null;
        }

        $urls = [
            'instagram' => 'https://www.instagram.com/',
            'facebook' => 'https://www.facebook.com/',
            'linkedin' => 'https://www.linkedin.com/in/',
            'twitter' => 'https://twitter.com/'
        ];

        if (!isset($urls[$platform]) || empty($socialData->$platform)) {
            return null;
        }

        return $urls[$platform] . $socialData->$platform;
    }
}
