<?php
namespace App\Providers;

use App\Models\Appointment;
use App\Models\Gallery;
use App\Models\Hero;
use App\Models\Product;
use App\Observers\AppointmentObserver;
use App\Observers\GalleryObserver;
use App\Observers\HeroObserver;
use App\Observers\ProductsObserver;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use BezhanSalleh\PanelSwitch\PanelSwitch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use NumberFormatter;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\Health\Checks\Checks\DatabaseSizeCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;
use Spatie\SecurityAdvisoriesHealthCheck\SecurityAdvisoriesCheck;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Handle post-registration logic for users.
     */
    protected function registered(Request $request, $user): void
    {
        $user->assignRole('panel_user');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureUrl();
        $this->configureModels();
        $this->configureCashier();
        $this->registerObservers();
        $this->configurePanelSwitch();
        $this->configureLanguageSwitch();
        $this->configureHealthChecks();
        $this->configureBladeDirectives();
    }

    /**
     * Configure base model behavior.
     */
    private function configureModels(): void
    {
        Model::shouldBeStrict();
        Model::unguard();
    }

    /**
     * Configure Cashier behavior.
     */
    private function configureCashier(): void
    {
        Cashier::calculateTaxes();
    }

    /**
     * Register model observers.
     */
    private function registerObservers(): void
    {
        Gallery::observe(GalleryObserver::class);
        Appointment::observe(AppointmentObserver::class);
        Product::observe(ProductsObserver::class);
        Hero::observe(HeroObserver::class);
    }

    /**
     * Configure panel switching functionality.
     */
    private function configurePanelSwitch(): void
    {
        PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
            $panelSwitch
                ->renderHook('panels::global-search.after')
                ->modalHeading('Available Panels')
                ->panels(['admin', 'team', 'customer'])
                ->slideOver()
                ->modalWidth('lg')
                ->icons([
                    'admin' => 'heroicon-s-user-circle',
                    'team' => 'heroicon-s-user-plus',
                    'customer' => 'heroicon-s-user',
                ])
                ->iconSize(16)
                ->labels([
                    'admin' => __('Admin'),
                    'team' => __('Team'),
                    'customer' => __('Customer'),
                ])
                ->visible(fn(): bool => auth()->user()?->hasAnyRole([
                    'super_admin'
                ]));
        });
    }

    /**
     * Configure language switching functionality.
     */
    private function configureLanguageSwitch(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch->locales(['ar', 'en', 'fr']);
        });
    }

    /**
     * Configure application health checks.
     */
    private function configureHealthChecks(): void
    {
        Health::checks([
            CacheCheck::new(),
            UsedDiskSpaceCheck::new(),
            SecurityAdvisoriesCheck::new(),
            DatabaseCheck::new(),
            OptimizedAppCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            DatabaseSizeCheck::new()
                ->failWhenSizeAboveGb(errorThresholdGb: 5.0),
            CpuLoadCheck::new()
                ->failWhenLoadIsHigherInTheLast5Minutes(2.0)
                ->failWhenLoadIsHigherInTheLast15Minutes(1.5),
            DatabaseConnectionCountCheck::new()
                ->failWhenMoreConnectionsThan(100)
        ]);
    }

    /**
     * Configure custom Blade directives and string handlers.
     */
    private function configureBladeDirectives(): void
    {
        Blade::stringable(function (Money $money) {
            $currencies = new ISOCurrencies();
            $numberFormatter = new NumberFormatter(config('USD'), NumberFormatter::CURRENCY);
            $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
            return $moneyFormatter->format($money);
        });
    }

    private function configureUrl(): void
    {
        URL::forceScheme('https');
    }
}
