<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('create-user', function ($user) {
            return $user->hasPermissionTo('create_user');
        });

        $gate->define('update-user', function ($user) {
            return $user->hasPermissionTo('update_user');
        });

        $gate->define('create-report', function ($user) {
            return $user->hasPermissionTo('create_report');
        });

        $gate->define('watch-all-reports', function ($user) {
            return $user->hasPermissionTo('watch-all-reports');
        });


    }
}
