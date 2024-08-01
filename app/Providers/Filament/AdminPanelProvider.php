<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\UsersChartWidget;
use App\Filament\Widgets\UsersCountWidget;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
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
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use LaraZeus\Boredom\BoringAvatarPlugin;
use LaraZeus\Boredom\BoringAvatarsProvider;
use LaraZeus\Boredom\Enums\Variants;
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
                    NavigationGroup::make('Business Information'),
                    NavigationGroup::make('SEO'),
                    NavigationGroup::make('Visuals'),
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
                FilamentAnnouncePlugin::make()
                    ->pollingInterval('30s') // optional, by default it is set to null
                    ->defaultColor(Color::Blue), // optional, by default it is set to "primary"
                SpotlightPlugin::make(),
                FilamentSpatieLaravelHealthPlugin::make()
                    ->usingPage(HealthCheckResults::class),
                FilamentShieldPlugin::make(),
                BoringAvatarPlugin::make()
                    ->variant(Variants::BEAM)
                    ->size(60)
                    ->square()
                    ->colors(['0A0310','49007E','FF005B','FF7D10','FFB238']),
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
            ->defaultAvatarProvider(
                BoringAvatarsProvider::class
            )
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->databaseNotifications()
//                ->profile(isSimple: false)
            ;
    }

    public function register(): void
    {
        parent::register();
        FilamentView::registerRenderHook('panels::body.end', fn(): string => Blade::render("@vite('resources/js/app.js')"));
    }
}
