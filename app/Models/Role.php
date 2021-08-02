<?php

namespace App\Models;

use App\Models\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Models
 *
 * @property array $permissions
 * @property string $name
 */
class Role extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'name',
        'permissions'
    ];

    protected $casts = [
        'permissions' => 'array'
    ];

    public function isAllowed(string $permission): bool
    {
        return in_array($permission, $this->permissions);
    }

}
