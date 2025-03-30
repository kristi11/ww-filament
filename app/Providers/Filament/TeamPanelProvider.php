<?php

namespace App\Providers\Filament;

use App\Filament\Customer\Widgets\BusinessHoursWidget;
use App\Filament\Customer\Widgets\ServicesWidget;
use App\Filament\Customer\Widgets\SocialsWidget;
use App\Filament\Pages\CustomChatifyPage;
use CharrafiMed\GlobalSearchModal\GlobalSearchModalPlugin;
use Exception;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Carbon;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Monzer\FilamentChatifyIntegration\ChatifyPlugin;
use Niladam\FilamentAutoLogout\AutoLogoutPlugin;
use Rupadana\FilamentAnnounce\FilamentAnnouncePlugin;

class TeamPanelProvider extends PanelProvider
{
    /**
     * @throws Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('team')
            ->path('team')
            ->brandName('Witty Workflow')
            ->brandLogo(asset('logo.svg'))
            ->brandLogoHeight('2rem')
            ->darkModeBrandLogo(asset('darkModeLogo.svg'))
            ->favicon(asset('favicon.svg'))
            ->colors([
                'primary' => Color::Amber,
            ])
            ->pages([
                Pages\Dashboard::class,
            ])
            ->brandName('Witty Workflow')
            ->colors([
                'primary' => Color::Violet,
                'gray' => Color::Gray,
            ])
            ->spa()
            ->login()
            ->passwordReset()
//            ->profile(isSimple: false)
            ->sidebarCollapsibleOnDesktop()
//            ->discoverWidgets(in: app_path('Filament/Customer/Widgets'), for: 'App\\Filament\\Customer\\Widgets')
            ->widgets([
                'socials' => SocialsWidget::class,
                'services' => ServicesWidget::class,
                'business_hours' => BusinessHoursWidget::class,
            ])
            ->plugins([
//                ChatifyPlugin::make()
//                    ->customPage(CustomChatifyPage::class)
//                    ->disableFloatingChatWidget(),
                AutoLogoutPlugin::make()
                    // Enable any of the following options if needed
//                    ->color(Color::Emerald)     // Set the color. Defaults to Zinc
//                    ->disableIf(fn () => auth()->id() === 1)        // Disable the user with ID 1
//                    ->logoutAfter(Carbon::SECONDS_PER_MINUTE * 5)   // Logout the user after 5 minutes
//                    ->withoutWarning()          // Disable the warning before logging out
//                    ->withoutTimeLeft()         // Disable the time left
//                    ->timeLeftText('Oh no. Kicking you in...')      // Change the time left text
//                    ->timeLeftText('')
                    ->logoutAfter(Carbon::SECONDS_PER_MINUTE * 30),
//              FilamentOtpLoginPlugin::make(), // uncomment to enable one time passwords
                GlobalSearchModalPlugin::make()
                    ->slideOver()
                    ->RetainRecentIfFavorite(true)
                    ->associateItemsWithTheirGroups(),
                ThemesPlugin::make(),
                \App\Filament\Plugins\BreezyCore::make()
                    ->myProfile(
                        shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = false)
                        shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
                        hasAvatars: false, // Sets the navigation group for the My Profile page (default = null)
                        slug: 'profile', // Enables the avatar upload form component (default = false)
                        navigationGroup: 'Settings' // Sets the slug for the profile page (default = 'my-profile')
                    )
                    ->enableTwoFactorAuthentication(
                    // force the user to enable 2FA before they can use the application (default = false)
                    ),
                FilamentAnnouncePlugin::make()
                    ->pollingInterval('30s') // optional, by default it is set to null
                    ->defaultColor(Color::Blue), // optional, by default it is set to "primary"
            ])
            ->discoverResources(in: app_path('Filament/Team/Resources'), for: 'App\\Filament\\Team\\Resources')
            ->discoverPages(in: app_path('Filament/Team/Pages'), for: 'App\\Filament\\Team\\Pages')
            ->discoverWidgets(in: app_path('Filament/Team/Widgets'), for: 'App\\Filament\\Team\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                SetTheme::class
            ])
            ->databaseNotifications()
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
