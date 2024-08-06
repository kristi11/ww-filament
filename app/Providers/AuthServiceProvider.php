<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\PublicPage;
use App\Models\SectionColors;
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
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
