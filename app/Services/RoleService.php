<?php


namespace App\Services;


use App\Contracts\Services\RoleServiceContract;
use App\Models\Organisation;
use App\Models\Role;

class RoleService implements RoleServiceContract
{

    public const ORGANISATION_VIEW = 'organisation_view';
    public const ORGANISATION_EDIT = 'organisation_edit';
    public const ORGANISATION_CREATE = 'organisation_create';
    public const ORGANISATION_DELETE = 'organisation_delete';

    public function getPermissionsMatrix(): array
    {
        return [
            Organisation::class => [
                self::ORGANISATION_VIEW,
                self::ORGANISATION_EDIT,
                self::ORGANISATION_CREATE,
                self::ORGANISATION_DELETE,
            ]
        ];
    }

}
