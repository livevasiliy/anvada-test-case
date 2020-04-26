<?php


namespace App\Repository;


use App\Contracts\DocumentContract;
use App\Enums\DocumentStatus;
use App\Models\Document;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class DocumentRepository
 * @package App\Repository
 */
class DocumentRepository extends BaseRepository implements DocumentContract
{
    /**
     * DocumentRepository constructor.
     *
     * @param Document $model
     *
     * @return void
     */
    public function __construct(Document $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    final public function allDocuments(array $columns = ['*']): Collection
    {
        return $this->model->all($columns);
    }

    /**
     * @inheritDoc
     */
    final public function paginateDocuments(int $perPage = 15, int $page = 1): LengthAwarePaginator
    {
        return $this->model->orderByDesc('id')->paginate($perPage, ['*'], $page);
    }

    /**
     * @inheritDoc
     */
    final public function createDocument(array $params): ?Document
    {
        return $this->model->create($params);
    }

    /**
     * @inheritDoc
     */
    final public function updateDocument(string $uuid, array $params): ?Document
    {
        $isUpdate = $this->model->find($uuid)->update([
            'payload' => $params
        ]);

        if (!$isUpdate)
        {
            return $this->model->whereId($uuid)->first(['*']);
        }

        return $this->model->whereId($uuid)->first(['*']);
    }

    /**
     * @inheritDoc
     */
    final public function findByDocument(array $params, array $columns = ['*']): ?Document
    {
        return $this->model->where($params)->first($columns);
    }

    /**
     * @inheritDoc
     */
    final public function findDocument(string $uuid, array $columns = ['*']): ?Document
    {
        return $this->model->whereId($uuid)->first($columns);
    }

    /**
     * @inheritDoc
     */
    final public function publishDocument(string $uuid): ?Document
    {
        $this->model->whereId($uuid)->update([
            'status' => DocumentStatus::PUBLISHED
        ]);

        return $this->model->whereId($uuid)->first(['*']);
    }
}
