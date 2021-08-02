<?php

namespace App\Providers;

use App\Contracts\Services\RoleServiceContract;
use App\Models\Organisation;
use App\Models\User;
use App\Policies\OrganisationPolicy;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Organisation::class => OrganisationPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /** @var RoleServiceContract $roleService */
        $roleService = resolve(RoleServiceContract::class);
        $matrix = $roleService->getPermissionsMatrix();

        foreach ($matrix as $model => $permissions) {
            foreach ($permissions as $permission) {
                Gate::define($permission, function (User $user) use ($permission) {
                    return $user->isAllowed($permission);
                });
            }
        }
    }
}
