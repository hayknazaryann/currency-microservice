<?php

namespace App\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentInterface
{
    /**
     * Get all instances of model
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Create a new record in the database
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Make a new object of the model
     *
     * @param array $data
     * @return Model
     */
    public function make(array $data): Model;

    /**
     * Update record in the database
     *
     * @param Model $model
     * @param array $data
     * @return EloquentInterface
     */
    public function update(Model $model, array $data): EloquentInterface;

    /**
     * Remove a record from the database
     *
     * @param Model $model
     * @return EloquentInterface
     */
    public function delete(Model $model): EloquentInterface;

    /**
     * Find a record by Primary Key
     *
     * @param mixed $key
     * @return Model|null
     */
    public function find(mixed $key): ?Model;

    /**
     * Show the record with the given id
     *
     * @param int $id
     * @return Model
     */
    public function findOrFail(int $id): Model;

    /**
     * Get paginated records
     *
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator;

    /**
     * @param array $attributes
     * @param array $values
     * @return Model
     */
    public function updateOrCreate(array $attributes, array $values = []): Model;


}
