<?php

namespace App\Actions\Footer;

use App\Models\About;
use App\Models\Contact;
use Illuminate\Support\Facades\Cache;

class GetFooterCompanyData
{
    /**
     * Get visibility data for footer company links
     *
     * @return array Array containing visibility status for about and contact
     */
    public function execute(): array
    {
        return [
            'about' => $this->getAboutVisibility(),
            'contact' => $this->getContactVisibility(),
        ];
    }

    /**
     * Get about visibility status
     *
     * @return bool|null
     */
    protected function getAboutVisibility(): ?bool
    {
        return Cache::remember('footer_company_about', now()->addMinutes(60), function () {
            return About::first()?->visibility;
        });
    }

    /**
     * Get contact visibility status
     *
     * @return bool|null
     */
    protected function getContactVisibility(): ?bool
    {
        return Cache::remember('footer_company_contact', now()->addMinutes(60), function () {
            return Contact::first()?->visibility;
        });
    }
}
