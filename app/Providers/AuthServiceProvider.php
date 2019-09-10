<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->authGates();
    }

    /**
     * declare authorisation gates (permissions)
     */
    private function authGates(): void
    {
        Gate::define('write-post', function ($user) {
            return $user->id == auth()->user()->id;
        });

        Gate::define('admin', function ($user) {
            return $user->admin == 1;
        });
    }
}
