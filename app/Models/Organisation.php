<?php

namespace App\Models;

use App\Models\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Organisation
 * @package App\Models
 *
 * @property string $name
 * @property Collection<User> $users
 */
class Organisation extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
