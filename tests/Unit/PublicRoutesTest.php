<?php

namespace Tests\Unit;

use Tests\TestCase;

class PublicRoutesTest extends TestCase
{
    /**
     * Test all public routes are accessible
     *
     * @dataProvider publicRoutes
     */
    public function test_public_routes_are_accessible(string $route, string $routeName)
    {
        $response = $this->get($route);

        $response->assertStatus(200);
    }

    /**
     * Data provider for public routes
     */
    public static function publicRoutes(): array
    {
        return [
            'Home page' => ['/', 'home'],
            'FAQ page' => ['/faq', 'faq'],
            'Help page' => ['/help', 'help'],
            'Support page' => ['/support', 'support'],
            'Privacy page' => ['/privacy', 'privacy'],
            'Terms page' => ['/terms', 'terms'],
            'Contact page' => ['/contact', 'contact'],
            'About page' => ['/about', 'about'],
            'Shop page' => ['/shop', 'shop'],
        ];
    }
    /**
     * Test login redirect
     */
    public function test_login_redirect()
    {
        $response = $this->get('/login');

        $response->assertRedirect('/admin/login');
    }
}
