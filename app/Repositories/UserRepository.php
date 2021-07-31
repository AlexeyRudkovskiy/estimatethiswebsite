<?php


namespace App\Repositories;


use App\Contracts\Repositories\UserRepositoryContract;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryContract
{

    protected ?string $modelClass = User::class;

    public function findByEmail(string $email): User
    {
        return User::query()
            ->whereEmail($email)
            ->firstOrFail();
    }

}
