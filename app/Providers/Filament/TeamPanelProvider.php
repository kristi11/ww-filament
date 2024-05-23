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
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use LaraZeus\Boredom\BoringAvatarPlugin;
use LaraZeus\Boredom\Enums\Variants;
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
                FilamentAnnouncePlugin::make()
                    ->pollingInterval('30s') // optional, by default it is set to null
                    ->defaultColor(Color::Blue), // optional, by default it is set to "primary"
                BoringAvatarPlugin::make()
                    ->variant(Variants::BEAM)
                    ->size(60)
                    ->square()
                    ->colors(['0A0310','49007E','FF005B','FF7D10','FFB238'])
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
            ])
            ->databaseNotifications()
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
