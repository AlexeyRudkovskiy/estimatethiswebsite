<?php


namespace App\Contracts\Repositories;


use App\Models\Organisation;
use App\Models\User;
use Illuminate\Support\Collection;

interface OrganisationRepositoryContract extends BaseRepositoryContract
{

    /**
     * @param Organisation $organisation
     * @return Collection<User>
     */
    public function getUsers(Organisation $organisation): Collection;

}
