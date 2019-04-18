<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function ($user) {
            Log::info(2);
            if (str_contains($user->permissions, 'super_admin')) {
                return true;
            }
        });

        Gate::define('admin-pms', function ($user, $permission) {
            Log::info(1);
            return str_contains($user->permissions, $permission);
        });
        //
    }
}
