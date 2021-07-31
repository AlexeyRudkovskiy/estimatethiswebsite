<?php


namespace App\Contracts\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryContract
{

    public function find(string $id);

    public function paginate(?int $perPage = null): LengthAwarePaginator;

    public function create(array $data): Model;

    public function update(string $id, array $data): Model;

}
