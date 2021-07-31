<?php


namespace App\Contracts\Repositories;


use App\Models\User;

interface UserRepositoryContract extends BaseRepositoryContract
{

    public function findByEmail(string $email): User;

}
