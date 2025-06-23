<?php

namespace Tests\Unit\Actions\Services;

use App\Actions\Services\GetPaginatedServices;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class GetPaginatedServicesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    /** @test */
    public function it_returns_paginated_services()
    {
        // Arrange
        $user = User::factory()->create();
        Service::factory()->count(5)->create(['user_id' => $user->id]);
        $action = new GetPaginatedServices();
        $perPage = 3;
        $currentPage = 1;

        // Act
        $result = $action->execute($perPage, $currentPage);

        // Assert
        $this->assertInstanceOf(Paginator::class, $result);
        $this->assertEquals($perPage, $result->perPage());
        $this->assertEquals(3, $result->count()); // Should have 3 items on the first page
    }

    /** @test */
    public function it_caches_results()
    {
        // Arrange
        $user = User::factory()->create();
        Service::factory()->count(5)->create(['user_id' => $user->id]);
        $action = new GetPaginatedServices();
        $perPage = 3;
        $currentPage = 1;
        $cacheKey = "services_page_{$currentPage}_{$perPage}";

        // Act
        $action->execute($perPage, $currentPage);

        // Assert
        $this->assertTrue(Cache::has($cacheKey));
    }

    /** @test */
    public function it_returns_different_results_for_different_pages()
    {
        // Arrange
        $user = User::factory()->create();
        // Create 10 services with specific names to ensure order
        for ($i = 1; $i <= 10; $i++) {
            Service::factory()->create([
                'user_id' => $user->id,
                'name' => "Service {$i}",
                'created_at' => now()->subDays($i) // Ensure different creation dates for ordering
            ]);
        }

        $action = new GetPaginatedServices();
        $perPage = 3;

        // Act
        $page1Results = $action->execute($perPage, 1);
        $page2Results = $action->execute($perPage, 2);

        // Assert
        // Get the names of services on each page
        $page1Names = $page1Results->pluck('name')->toArray();
        $page2Names = $page2Results->pluck('name')->toArray();

        // Verify there's no overlap between pages
        $this->assertEmpty(array_intersect($page1Names, $page2Names));
        $this->assertCount(3, $page1Results);
        $this->assertCount(3, $page2Results);
    }
}
