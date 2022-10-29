<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function create(array $data);

    public function read(array $attributes, array $conditions, int $perPage = 10);

    public function update(array $conditions, array $data);

    public function delete(array $conditions, bool $force = false): bool;
}
