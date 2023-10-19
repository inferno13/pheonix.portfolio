<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Passport::routes();

        /**
         * Defining the user Roles
         */
        
         Gate::define('isUser', function ($user) {
            return in_array('user', $user->getRoleNames());
        });


        Gate::define('isAdmin', function ($user) {
            return in_array('admin', $user->getRoleNames());
        });

        Gate::define('isSuperAdmin', function ($user) {
            return in_array('superadmin', $user->getRoleNames());
        });
    }
}
