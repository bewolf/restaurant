<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('manager', function ($user) {
            return in_array('manager', $user->roles->pluck('name')->toArray());
        });

        Gate::define('user', function ($user) {
            return in_array('user', $user->roles->pluck('name')->toArray());
        });

        Gate::define('shift_manager', function ($user) {
            return in_array('shift_manager', $user->roles->pluck('name')->toArray());
        });

        Gate::define('waiter', function ($user) {
            return in_array('waiter', $user->roles->pluck('name')->toArray());
        });
        Gate::define('bartender', function ($user) {
            return in_array('bartender', $user->roles->pluck('name')->toArray());
        });
        Gate::define('cook', function ($user) {
            return in_array('cook', $user->roles->pluck('name')->toArray());
        });
    }
}
