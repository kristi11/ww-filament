<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PublicPage;

class PublicPageAccessCheck
{
    public function handle(Request $request, Closure $next)
    {
        // Fetch the PublicPage settings
        $publicPage = PublicPage::where('shop', true)  // this checks the 'shop' column in the PublicPage model
            ->first();

        // If no PublicPage instance is found for this user (or public settings), return 404
        if (!$publicPage) {
            abort(404);
        }

        // Define the mapping between route and PublicPage section
        $sections = [
            'shop' => $publicPage->shop,
            'gallery' => $publicPage->gallery,
            'credentials' => $publicPage->credentials,
            'services' => $publicPage->services,
            'hours' => $publicPage->hours,
            'email' => $publicPage->email,
            'footer' => $publicPage->footer,
            'hero' => $publicPage->hero,
        ];

        // Check if the shop section is enabled and block routes accordingly
        if ($request->is('product/*') && !$publicPage->shop) {
            abort(403);  // Block access to /product/{product} if shop is disabled
        }

        if ($request->is('cart') && !$publicPage->shop) {
            abort(403);  // Block access to /cart if shop is disabled
        }

        if ($request->is('order/*') && !$publicPage->shop) {
            abort(403);  // Block access to /order/{orderId} if shop is disabled
        }

        // Check if the footer section is enabled and block routes accordingly
        if ($request->is('faq') && !$publicPage->footer) {
            abort(403);  // Block access to /faq if footer is disabled
        }

        if ($request->is('help') && !$publicPage->footer) {
            abort(403);  // Block access to /help if footer is disabled
        }

        if ($request->is('support') && !$publicPage->footer) {
            abort(403);  // Block access to /support if footer is disabled
        }

        if ($request->is('privacy') && !$publicPage->footer) {
            abort(403);  // Block access to /privacy if footer is disabled
        }

        if ($request->is('terms') && !$publicPage->footer) {
            abort(403);  // Block access to /terms if footer is disabled
        }

        if ($request->is('contact') && !$publicPage->footer) {
            abort(403);  // Block access to /contact if footer is disabled
        }

        if ($request->is('about') && !$publicPage->footer) {
            abort(403);  // Block access to /about if footer is disabled
        }

        // Loop through all sections and block access for any disabled section
        foreach ($sections as $route => $enabled) {
            // Block access if section is disabled
            if ($request->is($route) && !$enabled) {
                abort(403); // Block access if section is disabled
            }
        }

        return $next($request);
    }
}
