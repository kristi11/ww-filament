<?php

namespace App\Actions\Services;

use App\Models\Flexibility;
use Illuminate\Support\Facades\Cache;

class CheckFlexiblePricing
{
    /**
     * Check if flexible pricing is enabled
     */
    public function execute(): ?Flexibility
    {
        return Cache::remember('flexible_pricing', now()->addMinutes(60), function () {
            return Flexibility::where('flexible_pricing', true)->first();
        });
    }
}
