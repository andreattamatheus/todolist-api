<?php

namespace App\Repositories\Base;

use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function first(): ?Model
    {
        return $this->model->first();
    }

    public function find($id, $withRelations = []): ?Model
    {
        $builder = $this->model;

        if (count($withRelations)) {
            $builder = $builder->with($withRelations);
        }

        return $builder->find($id);
    }

    public function findWithTrashed($id, $withRelations = []): ?Model
    {
        $builder = $this->model->withTrashed();

        if (count($withRelations)) {
            $builder = $builder->with($withRelations);
        }

        return $builder->find($id);
    }

    public function findOrFail($id, $withRelations = []): Model
    {
        $model = $this->find($id, $withRelations);

        if (!$model) {
            throw new EntityNotFoundException(__('errors.entity_not_found_error'), ResponseAlias::HTTP_NOT_FOUND);
        }

        return $model;
    }

    public function findOrFailWithTrashed($id, $withRelations = []): Model
    {
        $model = $this->findWithTrashed($id, $withRelations);

        if (!$model) {
            throw new EntityNotFoundException(__('errors.entity_not_found_error'), ResponseAlias::HTTP_NOT_FOUND);
        }

        return $model;
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function destroy($id): bool
    {
        $model = $this->findOrFail($id);

        return $model->delete();
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model;
    }

    public function updateWithModelEvents(Model $model, array $data): Model
    {
        foreach ($data as $key => $value) {
            $model->{$key} = $value;
        }

        $model->save();

        return $model;
    }

    public function restore($id): Model
    {
        $model = $this->model->onlyTrashed()->find($id);

        if (!$model) {
            throw new EntityNotFoundException(__('errors.entity_not_found_error'), ResponseAlias::HTTP_NOT_FOUND);
        }

        $model->restore();

        return $model;
    }

    public function firstOrCreate(array $data): Model
    {
        return $this->model->firstOrCreate($data);
    }

    private function resolveModel(): Model
    {
        return app($this->model);
    }
}
