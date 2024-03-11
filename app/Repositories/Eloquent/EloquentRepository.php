<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\EloquentInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

abstract class EloquentRepository implements EloquentInterface
{
  /**
   * @var Model
   */
  protected Model $model;

  /**
   * @inheritDoc
   */
  public function paginate(): LengthAwarePaginator
  {
    return $this->getModel()->paginate(15);
  }

  /**
   * @inheritDoc
   */
  public function all(): Collection
  {
    return $this->getModel()->all();
  }

  /**
   * @inheritDoc
   */
  public function find($key): ?Model
  {
    return $this->getModel()->find($key);
  }

  /**
   * @inheritDoc
   */
  public function findOrFail(int $id): Model
  {
    return $this->getModel()->findOrFail($id);
  }

  /**
   * @inheritDoc
   */
  public function create(array $data): Model
  {
    return $this->getModel()->create($data);
  }

  /**
   * @inheritDoc
   */
  public function make(array $data): Model
  {
    return $this->getModel()->make($data);
  }

  /**
   * @inheritDoc
   */
  public function update(Model $model, array $data): EloquentInterface
  {
    $model->update($data);
    return $this;
  }

  /**
   * @inheritDoc
   */
  public function updateOrCreate(array $attributes, array $values = []): Model
  {
    return $this->getModel()->updateOrCreate($attributes, $values);
  }

  /**
   * @inheritDoc
   */
  public function delete(Model $model): EloquentInterface
  {
    $model->delete();
    return $this;
  }


  /**
   * @return Model
   */
  protected function getModel(): Model
  {
    if (!$this->model instanceof Model) {
      throw new InvalidArgumentException('Model must be an instance of Illuminate\Database\Eloquent\Model');
    }
    return $this->model;
  }
}
