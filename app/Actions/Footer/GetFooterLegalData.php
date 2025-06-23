<?php

namespace App\Actions\Footer;

use App\Models\Privacy;
use App\Models\Terms;
use Illuminate\Support\Facades\Cache;

class GetFooterLegalData
{
    /**
     * Get visibility data for footer legal links
     *
     * @return array Array containing visibility status for terms and privacy
     */
    public function execute(): array
    {
        return [
            'terms' => $this->getTermsVisibility(),
            'privacy' => $this->getPrivacyVisibility(),
        ];
    }

    /**
     * Get terms visibility status
     *
     * @return bool|null
     */
    protected function getTermsVisibility(): ?bool
    {
        return Cache::remember('footer_legal_terms', now()->addMinutes(60), function () {
            return Terms::first()?->visibility;
        });
    }

    /**
     * Get privacy visibility status
     *
     * @return bool|null
     */
    protected function getPrivacyVisibility(): ?bool
    {
        return Cache::remember('footer_legal_privacy', now()->addMinutes(60), function () {
            return Privacy::first()?->visibility;
        });
    }
}
