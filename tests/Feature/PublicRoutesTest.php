<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class PublicRoutesTest extends TestCase
{
    /**
     * Test that all public routes are defined in the application
     *
     * @dataProvider publicRouteProvider
     */
    public function test_public_routes_are_accessible(string $route, string $routeName)
    {
        // Only test that the route exists and is defined
        $this->assertTrue(Route::has($routeName), "Route name '$routeName' does not exist");
    }

    /**
     * Test that the route definitions match the expected URLs
     *
     * @dataProvider publicRouteProvider
     */
    public function test_route_definitions_match_expected_urls(string $route, string $routeName)
    {
        // Test that the named route generates the expected URL
        $this->assertEquals($route, route($routeName, [], false));
    }

    public static function publicRouteProvider(): array
    {
        return [
            'Home' => ['/', 'home'],
            'FAQ' => ['/faq', 'faq'],
            'Help' => ['/help', 'help'],
            'Support' => ['/support', 'support'],
            'Privacy' => ['/privacy', 'privacy'],
            'Terms' => ['/terms', 'terms'],
            'Contact' => ['/contact', 'contact'],
            'About' => ['/about', 'about'],
            'Shop' => ['/shop', 'shop'],
        ];
    }
}
