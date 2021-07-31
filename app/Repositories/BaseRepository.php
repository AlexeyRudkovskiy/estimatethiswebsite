<?php


namespace App\Repositories;


use App\Contracts\Repositories\BaseRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository implements BaseRepositoryContract
{

    /** @var ?string Model class name */
    protected ?string $modelClass = null;

    public function find(string $id)
    {
        return call_user_func_array([ $this->modelClass, 'find' ], [ $id ]);
    }

    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return call_user_func_array([ $this->modelClass, 'query' ], [])
            ->paginate($perPage);
    }

    public function create(array $data): Model
    {
        return call_user_func([ $this->modelClass, 'create' ], $data);
    }

    public function update(string $id, array $data): Model
    {
        $object = $this->find($id);
        $object->update($data);

        return $object;
    }

}
