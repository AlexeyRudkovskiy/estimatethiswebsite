<?php


namespace Tests\Traits;


use App\Models\Role;

trait ExcludePermission
{

    public function excludePermission(Role $role, string $permission): Role
    {
        $permissions = array_filter($role->permissions, function ($item) use ($permission) {
            return $item !== $permission;
        });

        $role->permissions = array_values($permissions);
        $role->save();

        return $role;
    }

}
