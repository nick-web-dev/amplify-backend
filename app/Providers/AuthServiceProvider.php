<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Modules\Auth\Policies\RolesPolicy;
use Modules\Campaign\Entities\DestinationUrl;
use Modules\Campaign\Entities\Metrics;
use Modules\Campaign\Policies\DestinationUrlPolicy;
use Modules\Campaign\Policies\MetricsPolicy;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',

        Role::class => RolesPolicy::class,
        Metrics::class => MetricsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensExpireIn(now()->addDays(30));
        Passport::refreshTokensExpireIn(now()->addDays(60));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
        //
    }
}
