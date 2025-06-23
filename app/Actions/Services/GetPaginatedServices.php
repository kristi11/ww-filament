<?php

namespace App\Actions\Services;

use App\Models\Service;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class GetPaginatedServices
{
    /**
     * Get paginated services with caching
     *
     * @param int $perPage Number of services per page
     * @param int $currentPage Current page number
     * @return Paginator
     */
    public function execute(int $perPage, int $currentPage = 1): Paginator
    {
        // Create a cache key based on the page and per page values
        $cacheKey = "services_page_{$currentPage}_{$perPage}";

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($perPage, $currentPage) {
            return Service::with('user')
                ->latest() // Ensure consistent ordering
                ->simplePaginate($perPage, ['*'], 'page', $currentPage);
        });
    }
}
