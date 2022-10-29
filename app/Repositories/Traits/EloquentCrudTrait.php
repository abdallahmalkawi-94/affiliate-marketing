<?php

namespace App\Repositories\Traits;

trait EloquentCrudTrait
{
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function read(array $attributes, array $conditions, int $perPage = 10)
    {
        return $this->model->select($attributes)->where($conditions)->paginate($perPage);
    }

    public function update(array $conditions, array $data): bool
    {
        return $this->model->where($conditions)->update($data);
    }

    public function delete(array $conditions, bool $force = false): bool
    {
        $method = $force ? 'forceDelete' : 'delete';

        return $this->model->where($conditions)->{$method}();
    }
}
