<?php

namespace App\Providers\Filament;

use Afsakar\FilamentOtpLogin\FilamentOtpLoginPlugin;
use App\Filament\Widgets\UsersChartWidget;
use App\Filament\Widgets\UsersCountWidget;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use CharrafiMed\GlobalSearchModal\GlobalSearchModalPlugin;
use Exception;
use Filament\Forms\Components\FileUpload;
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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Niladam\FilamentAutoLogout\AutoLogoutPlugin;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Rupadana\FilamentAnnounce\FilamentAnnouncePlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;
use TomatoPHP\FilamentPWA\FilamentPWAPlugin;

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
            ->emailVerification()
            ->colors([
                'primary' => Color::Indigo,
                'gray' => Color::Slate,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->navigationGroups(
                [
                    NavigationGroup::make('Settings'),
                    NavigationGroup::make('Business Information'),
                    NavigationGroup::make('Shop'),
                    NavigationGroup::make('Footer'),
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
//                FilamentPWAPlugin::make(), //This plugin shouldn't be activated as of now since im still trying to figure out the configurations mo make it work properly
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
//                Blog::make(),Enable to enable the FBlog plugin. Also, you'd have to enable BlogPostResource::class in AppServiceProvider
                //FilamentOtpLoginPlugin::make(), // uncomment to enable one time passwords
                GlobalSearchModalPlugin::make()
                    ->slideOver()
                    ->RetainRecentIfFavorite(true)
                    ->associateItemsWithTheirGroups(),
                ThemesPlugin::make(),
                \App\Filament\Plugins\BreezyCore::make()
                    ->avatarUploadComponent(fn($fileUpload) => $fileUpload->disableLabel())
                    ->myProfile(
                        shouldRegisterUserMenu: true,
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
            ->databaseNotifications()
            //->profile(isSimple: false)
            ;
    }

    public function register(): void
    {
        parent::register();
        FilamentView::registerRenderHook('panels::body.end',
            fn(): string => Blade::render("@vite('resources/js/app.js')"));
    }
}
