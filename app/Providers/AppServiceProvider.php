<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Models\Gallery;
use App\Models\Hero;
use App\Models\Product;
use App\Models\PublicPage;
use App\Models\SectionColors;
use App\Models\Social;
use App\Observers\AppointmentObserver;
use App\Observers\GalleryObserver;
use App\Observers\HeroObserver;
use App\Observers\ProductsObserver;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use BezhanSalleh\PanelSwitch\PanelSwitch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
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
        if (Schema::hasTable('heroes')) {
            Hero::observe(HeroObserver::class);
        }
        $this->configureUrl();
        $this->configureModels();
        $this->configureCashier();
        $this->configureViewData();
        $this->registerObservers();
        $this->configurePanelSwitch();
        $this->configureLanguageSwitch();
        $this->configureHealthChecks();
        $this->configureBladeDirectives();
        $this->configurePageVisibilitySettings();
    }

    /**
     * Configure visibility settings for various page sections
     *
     * @param  string  $section  The section name to configure
     * @param  string|null  $viewVariable  The name of the view variable (default: same as section)
     * @return void
     */
    private function configureVisibility(string $section, ?string $viewVariable = null): void
    {
        $viewVariable = $viewVariable ?? $section;
        try {
            $cacheKey = "visibility_{$section}";
            $model = cache()->remember($cacheKey, now()->addMinutes(60), function () use ($section) {
                return PublicPage::where($section, true)->first();
            });
            View::share($viewVariable, $model);
        } catch (\Exception $e) {
            // Fallback to direct query if caching fails
            $model = PublicPage::where($section, true)->first();
            View::share($viewVariable, $model);
        }
    }

    /**
     * Configure all visibility settings for public pages
     *
     * @return void
     */
    private function configurePageVisibilitySettings(): void
    {
        $this->configureVisibility('hero', 'publicHero');
        $this->configureVisibility('hours', 'guestHours');
        $this->configureVisibility('services', 'guestServices');
        $this->configureVisibility('footer');
        $this->configureVisibility('credentials');
        $this->configureVisibility('gallery');
        $this->configureVisibility('email');
    }

    /**
     * Configure base model behavior.
     */
    private function configureModels(): void
    {
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
     * Force HTTPS for all URLs.
     */
    private function configureUrl(): void
    {
        URL::forceScheme('https');
    }

    /**
     * Configure and share data with views.
     */
    private function configureViewData(): void
    {
        // Share single model instances with caching
        $this->shareCachedModel('hero', Hero::class, fn() => Hero::first(), 60);
        $this->shareCachedModel('background', SectionColors::class, fn() => SectionColors::first(), 60);
        $this->shareCachedModel('social', Social::class, fn() => Social::first(), 60);

        // Share PublicPage models filtered by specific boolean flags
        $this->sharePublicPageByFlag('shop');
        $this->sharePublicPageByFlag('services');
        $this->sharePublicPageByFlag('hours');
        $this->sharePublicPageByFlag('email');
    }

    /**
     * Helper method to share a model instance with views.
     *
     * @param  string  $key  The view variable name
     * @param  mixed  $model  The model instance to share
     */
    private function shareModel(string $key, $model): void
    {
        View::share($key, $model);
    }

    /**
     * Helper method to share a cached model instance with views.
     *
     * @param  string  $key  The view variable name
     * @param  string  $modelClass  The model class name
     * @param  \Closure  $query  The query to execute
     * @param  int  $minutes  Cache duration in minutes
     */
    private function shareCachedModel(string $key, string $modelClass, \Closure $query, int $minutes = 60): void
    {
        try {
            $cacheKey = "shared_model_{$key}";
            $model = cache()->remember($cacheKey, now()->addMinutes($minutes), $query);
            View::share($key, $model);
        } catch (\Exception $e) {
            // Fallback to direct query if caching fails (e.g., Redis not available)
            $model = $query();
            View::share($key, $model);
        }
    }

    /**
     * Share a PublicPage model filtered by a specific flag.
     *
     * @param  string  $flag  The boolean flag to filter by
     */
    private function sharePublicPageByFlag(string $flag): void
    {
        try {
            $cacheKey = "public_page_{$flag}";
            $model = cache()->remember($cacheKey, now()->addMinutes(60), function () use ($flag) {
                return PublicPage::where($flag, true)->first();
            });
            View::share($flag, $model);
        } catch (\Exception $e) {
            // Fallback to direct query if caching fails
            $model = PublicPage::where($flag, true)->first();
            View::share($flag, $model);
        }
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
}
