<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // 0===Admin , 1===Manager , 2===User
        Gate::define('employee', function ($user) {
            return in_array($user->role, ['admin']);
        });
        Gate::define('branch', function ($user) {
            return in_array($user->role, ['admin', 'manager', 'staff', 'accountant']);
        });
        Gate::define('room', function ($user) {
            return in_array($user->role, ['admin', 'manager', 'staff', 'accountant']);
        });
        Gate::define('contract', function ($user) {
            return in_array($user->role, ['admin', 'manager', 'accountant']);
        });
    }
}
