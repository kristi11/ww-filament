<?php

namespace Tests\Feature;

use Exception;
use Tests\TestCase;

class PublicRoutesTest extends TestCase
{
    /**
     * @dataProvider publicRouteProvider
     */
    public function test_public_routes_are_accessible(string $route, string $routeName)
    {
        try {
            $response = $this->get($route);
            $response->assertStatus(200);
        } catch (Exception $e) {
            $this->fail("Route $route ($routeName) failed: " . $e->getMessage());
        }
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
