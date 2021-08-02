<?php


namespace App\Contracts\Services;


use App\Models\Role;

interface RoleServiceContract
{

    public function getPermissionsMatrix(): array;

}
