<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\PublicPage;
use App\Models\SectionColors;
use App\Policies\AppointmentPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ProductVariantPolicy;
use App\Policies\PublicPagePolicy;
use App\Policies\SectionColorsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

        PublicPage::class => PublicPagePolicy::class,
        SectionColors::class => SectionColorsPolicy::class,
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
        ProductVariant::class => ProductVariantPolicy::class,
        Appointment::class => AppointmentPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
