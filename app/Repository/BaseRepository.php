<?php


namespace App\Repository;


use App\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

/**
 * Class BaseRepository
 * @package App\Repository
 */
class BaseRepository implements BaseContract
{
    /** @var Model */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * Get all
     *
     * @param array|string[] $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->model->get($columns);
    }

    /**
     * Paginate all
     *
     * @param int $perPage
     * @param array|string[] $columns
     * @param string $pageName
     * @param int $page
     * @return Paginator
     */
    public function paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'data', int $page = 1): Paginator
    {
        return $this->model->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * Create new instance model
     *
     * @param array $params
     * @return Model|null
     */
    public function create(array $params): ?Model
    {
        return $this->model->create($params);
    }

    /**
     * Find model by the given UUID
     *
     * @param string $uuid
     * @return Model|null
     */
    public function show(string $uuid): ?Model
    {
        return $this->find($uuid);
    }

    /**
     * Update model by the given UUID
     *
     * @param string $uuid
     * @param array $params
     * @return bool
     */
    public function update(string $uuid, array $params): bool
    {
        return $this->model->whereId($uuid)->update($params);
    }

    /**
     * Delete model by the given UUID
     *
     * @param string $uuid
     * @return bool
     */
    public function delete(string $uuid): bool
    {
        return $this->model->destroy($uuid);
    }

    /**
     * Find model by the given params
     *
     * @param array $params
     * @param array|string[] $columns
     * @return Model|null
     */
    public function findBy(array $params, array $columns = ['*']): ?Model
    {
        return $this->model->where($params)->first($columns);
    }

    /**
     * Find model by UUID
     *
     * @param string $uuid
     * @param array|string[] $columns
     * @return Model|null
     */
    public function find(string $uuid, array $columns = ['*']): ?Model
    {
        return $this->model->whereId($uuid)->first($columns);
    }
}
