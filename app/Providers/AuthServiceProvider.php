<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', function($user){
            return $user->level === 'Administrator';
        });
        Gate::define('isMedia', function($user){
            return $user->level === 'Media';
        });
        Gate::define('isMarketing', function($user){
            return $user->level === 'Marketing';
        });
        Gate::define('isAccounting', function($user){
            return $user->level === 'Accounting';
        });
        Gate::define('isWorkshop', function($user){
            return $user->level === 'Workshop';
        });
        Gate::define('isOwner', function($user){
            return $user->level === 'Owner';
        });
    }
}
