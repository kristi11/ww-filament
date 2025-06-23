<?php

namespace App\Actions\Footer;

use App\Models\FAQdata;
use App\Models\Help;
use App\Models\Support;
use Illuminate\Support\Facades\Cache;

class GetFooterLinksData
{
    /**
     * Get visibility data for footer links
     *
     * @return array Array containing visibility status for FAQ, help, and support
     */
    public function execute(): array
    {
        return [
            'faq' => $this->getFaqVisibility(),
            'help' => $this->getHelpVisibility(),
            'support' => $this->getSupportVisibility(),
        ];
    }

    /**
     * Get FAQ visibility status
     *
     * @return bool|null
     */
    protected function getFaqVisibility(): ?bool
    {
        return Cache::remember('footer_links_faq', now()->addMinutes(60), function () {
            return FAQdata::first()?->visibility;
        });
    }

    /**
     * Get help visibility status
     *
     * @return bool|null
     */
    protected function getHelpVisibility(): ?bool
    {
        return Cache::remember('footer_links_help', now()->addMinutes(60), function () {
            return Help::first()?->visibility;
        });
    }

    /**
     * Get support visibility status
     *
     * @return bool|null
     */
    protected function getSupportVisibility(): ?bool
    {
        return Cache::remember('footer_links_support', now()->addMinutes(60), function () {
            return Support::first()?->visibility;
        });
    }
}
