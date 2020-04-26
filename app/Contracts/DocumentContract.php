<?php


namespace App\Contracts;

use App\Models\Document;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Interface DocumentContract
 * @package App\Contracts
 */
interface DocumentContract
{
    /**
     * Get collection all records.
     *
     * Получить коллекцию всех записей.
     *
     * @param array|string[] $columns
     * @return Collection
     */
    public function allDocuments(array $columns = ['*']): Collection;

    /**
     * Get paginate collection all records.
     *
     * Получить коллекцию всех записей с пагинацей.
     *
     * @param int $perPage
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginateDocuments(int $perPage, int $page): LengthAwarePaginator;

    /**
     * Create new instance model.
     *
     * Создать новый экземпляр модели.
     *
     * @param array $params
     * @return null|Document
     */
    public function createDocument(array $params): ?Document;

    /**
     * Update model by the given UUID.
     *
     * Обновить модель по заданному UUID.
     *
     * @param array $params
     * @param string $uuid
     * @return null|Document
     */
    public function updateDocument(string $uuid, array $params): ?Document;

    /**
     * Find model by a specific column.
     *
     * Найти модель по конкретному столбцу.
     *
     * @param array $params
     * @param array|string[] $columns
     * @return null|Document
     */
    public function findByDocument(array $params, array $columns = ['*']): ?Document;

    /**
     * Find model by the given UUID.
     *
     * Найти модель по заданному UUID.
     *
     * @param string $uuid
     * @param array|string[] $columns
     * @return null|Document
     */
    public function findDocument(string $uuid, array $columns = ['*']): ?Document;

    /**
     * Publish model by the given UUID.
     *
     * Опубликовать модель по заданному UUID.
     *
     * @param string $uuid
     *
     * @return null|Document
     */
    public function publishDocument(string $uuid): ?Document;
}
