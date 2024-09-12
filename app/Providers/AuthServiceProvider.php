<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Cart;
use App\Models\cartItem;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\PublicPage;
use App\Models\SectionColors;
use App\Policies\cartItemPolicy;
use App\Policies\CartPolicy;
use App\Policies\ImagePolicy;
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
        //
        PublicPage::class => PublicPagePolicy::class,
        SectionColors::class => SectionColorsPolicy::class,
        Product::class => ProductPolicy::class,
        ProductVariant::class => ProductVariantPolicy::class,
        Cart::class => CartPolicy::class,
        cartItem::class => cartItemPolicy::class,
        Image::class => ImagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
