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
        ];
    }

    /**
     * Test routes that require public-page-check middleware
     */
    public function test_public_shop_routes_are_accessible()
    {
        // Test shop page
        $response = $this->get('/shop');
        $response->assertStatus(200);

        // Test product page (you'll need a valid product ID)
//         $response = $this->get('/product/1');
//         $response->assertStatus(200);

        // Test cart page
        $response = $this->get('/cart');
        $response->assertStatus(200);

        // Test checkout status page
        $response = $this->get('/checkout-status');
        $response->assertStatus(200);

        // Test order view page (you'll need a valid order ID)
        // $response = $this->get('/order/1');
        // $response->assertStatus(200);
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
