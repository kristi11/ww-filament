<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\UsersChartWidget;
use App\Filament\Widgets\UsersCountWidget;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use CharrafiMed\GlobalSearchModal\GlobalSearchModalPlugin;
use Exception;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentView;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Rupadana\FilamentAnnounce\FilamentAnnouncePlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;

class AdminPanelProvider extends PanelProvider
{
    /**
     * @throws Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->authGuard('web')
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('Witty Workflow')
            ->brandLogo(asset('logo.svg'))
            ->brandLogoHeight('2rem')
            ->darkModeBrandLogo(asset('darkModeLogo.svg'))
            ->favicon(asset('favicon.svg'))
            ->login()
            ->passwordReset()
//            ->profile() Uncomment this line to enable the profile page
            ->colors([
                'primary' => Color::Indigo,
                'gray' => Color::Slate,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->navigationGroups(
                [
                    NavigationGroup::make('Business Information')->icon('heroicon-o-briefcase'),
                    NavigationGroup::make('Shop')->icon('heroicon-o-building-storefront'),
                    NavigationGroup::make('Socials')->icon('heroicon-o-user-circle'),
                    NavigationGroup::make('Visuals')->icon('heroicon-o-photo'),
                    NavigationGroup::make('Footer')->icon('heroicon-o-document-minus'),
                    NavigationGroup::make('System')->icon('heroicon-o-settings')
                ]
            )
            ->spa()
            ->sidebarCollapsibleOnDesktop()
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                UsersCountWidget::class,
                UsersChartWidget::class
            ])
            ->plugins([
                GlobalSearchModalPlugin::make()
                    ->slideOver()
                    ->RetainRecentIfFavorite(true)
                    ->associateItemsWithTheirGroups(),
//                FilamentSpatieLaravelBackupPlugin::make(),
                ThemesPlugin::make(),
                BreezyCore::make()
                    ->myProfile(
                        shouldRegisterUserMenu: false,
                        // Sets the 'account' link in the panel User Menu (default = false)
                        shouldRegisterNavigation: false,
                        // Adds a main navigation item for the My Profile page (default = false)
                        hasAvatars: true, // Sets the navigation group for the My Profile page (default = null)
                        slug: 'profile', // Enables the avatar upload form component (default = false)
                        navigationGroup: 'Settings' // Sets the slug for the profile page (default = 'my-profile')

                    )
                    ->enableTwoFactorAuthentication(
                    // force the user to enable 2FA before they can use the application (default = false)
                    ),
                FilamentAnnouncePlugin::make()
                    ->pollingInterval('1s') // optional, by default it is set to null
                    ->defaultColor(Color::Blue), // optional, by default it is set to "primary"
                SpotlightPlugin::make(),
                FilamentSpatieLaravelHealthPlugin::make()
                    ->usingPage(HealthCheckResults::class),
//                FilamentShieldPlugin::make(),
                FilamentShieldPlugin::make()
                    ->gridColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 3
                    ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 2,
                    ])
                    ->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
            ])
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
            ->authMiddleware([
                Authenticate::class,
            ])
            ->databaseNotifications()//->profile(isSimple: false)
            ;
    }

    public function register(): void
    {
        parent::register();
        FilamentView::registerRenderHook('panels::body.end',
            fn(): string => Blade::render("@vite('resources/js/app.js')"));
    }
}
