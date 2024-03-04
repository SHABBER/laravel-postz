<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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


        //

        if(env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        Gate::define('is_admin', function($user){
            if($user->roles->pluck('name')->contains('admin'))
                return true;
            else
                return false;
        });

        Gate::define('access-admin', function ($user) {
            return true;
        });

        Gate::define('viewprofile', function($user, $id){
            // dd($user->id, $id);
            return $user->id == $id;
        });

        
        Gate::define('update_role', function($user){
            // dd($u->id, $user->id);
            return $user->roles->pluck('name')->contains('admin');
            // return $user->id == $u->id;
        });
        
    }
}
