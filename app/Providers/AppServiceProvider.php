<?php

namespace App\Providers;

use App\Actions\Shop\MigrateSessionCart;
use App\Factories\CartFactory;
use App\Models\Appointment;
use App\Models\Gallery;
use App\Models\Hero;
use App\Models\Product;
use App\Models\User;
use App\Observers\AppointmentObserver;
use App\Observers\GalleryObserver;
use App\Observers\HeroObserver;
use App\Observers\ProductsObserver;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use BezhanSalleh\PanelSwitch\PanelSwitch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Laravel\Fortify\Fortify;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
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
    protected function registered(Request $request, $user)
    {
        $user->assignRole('panel_user');
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
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
                ->visible(fn (): bool => auth()->user()?->hasAnyRole([
                    'super_admin'
                ]));;
        });
        Model::unguard();

        Cashier::calculateTaxes();
//        Fortify::authenticateUsing(function (Request $request) {
//            $user = User::where('email', $request->email)->first();
//
//            if ($user && Hash::check($request->password, $user->password)) {
//                (new MigrateSessionCart)->migrate(CartFactory::make(), $user?->cart ?: $user->cart()->create());
//                return $user;
//            }
//        });

        Gallery::observe(GalleryObserver::class);
        Appointment::observe(AppointmentObserver::class);
        Product::observe(ProductsObserver::class);
        Hero::observe(HeroObserver::class);
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar','en','fr']);
        });
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
        Blade::stringable(function (Money $money){
            $currencies = new ISOCurrencies();
            $numberFormatter = new \NumberFormatter(config('USD'), \NumberFormatter::CURRENCY);
            $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

            return $moneyFormatter->format($money);
        });
    }
}
