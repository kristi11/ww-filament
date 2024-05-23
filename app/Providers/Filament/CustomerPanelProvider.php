<?php

namespace App\Providers\Filament;

use App\Filament\Customer\Widgets\BusinessHoursWidget;
use App\Filament\Customer\Widgets\ServicesWidget;
use App\Filament\Customer\Widgets\SocialsWidget;
use Exception;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
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
use Rupadana\FilamentAnnounce\FilamentAnnouncePlugin;

class CustomerPanelProvider extends PanelProvider
{
//    protected int | string | array $columnSpan = 'full';
    /**
     * @throws Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('customer')
            ->path('dashboard')
            ->brandName('Witty Workflow')
            ->brandLogo(asset('logo.svg'))
            ->brandLogoHeight('2rem')
            ->darkModeBrandLogo(asset('darkModeLogo.svg'))
            ->favicon(asset('favicon.svg'))
            ->colors([
                'primary' => Color::Purple,
                'gray' => Color::Gray,
            ])
            ->spa()
            ->discoverResources(in: app_path('Filament/Customer/Resources'), for: 'App\\Filament\\Customer\\Resources')
            ->discoverPages(in: app_path('Filament/Customer/Pages'), for: 'App\\Filament\\Customer\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->login()
            ->registration()
            ->passwordReset()
            ->profile(isSimple: false)
            ->sidebarCollapsibleOnDesktop()
//            ->discoverWidgets(in: app_path('Filament/Customer/Widgets'), for: 'App\\Filament\\Customer\\Widgets')
            ->widgets([
                'socials' => SocialsWidget::class,
                'services' => ServicesWidget::class,
                'business_hours' => BusinessHoursWidget::class,
            ])
            ->plugins([
                FilamentAnnouncePlugin::make()
                    ->pollingInterval('30s') // optional, by default it is set to null
                    ->defaultColor(Color::Blue), // optional, by default it is set to "primary"
                BoringAvatarPlugin::make()
                    ->variant(Variants::BEAM)
                    ->size(60)
                    ->square()
                    ->colors(['0A0310','49007E','FF005B','FF7D10','FFB238'])
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
            ->databaseNotifications()
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    public function register(): void
    {
        parent::register();
        FilamentView::registerRenderHook('panels::body.end', fn(): string => Blade::render("@vite('resources/js/app.js')"));
    }
}
