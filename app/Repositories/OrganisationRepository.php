<?php


namespace App\Repositories;


use App\Contracts\Repositories\OrganisationRepositoryContract;
use App\Models\Organisation;
use Illuminate\Support\Collection;

class OrganisationRepository extends BaseRepository implements OrganisationRepositoryContract
{

    protected $modelClass = Organisation::class;

    public function getUsers(Organisation $organisation): Collection
    {
        return $organisation->users;
    }

}
