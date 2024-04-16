<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\Permission;

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
        //create our gates
        try {
            // all auth user role gates
            $roles = Role::all();
            //for auth users we create a gate
            foreach ($roles as $role) {
                Gate::define($role->name, function ($user) use ($role) {
                    return $user->hasRole($role->name); 
                });
            }
            //all auth permisions gate
            $permissions = Permission::all();
            foreach ($permissions as $permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasPermission($permission->name); 
                });
            }

        } catch (\Exception $event) {
            return $event;
        }
    }
}
