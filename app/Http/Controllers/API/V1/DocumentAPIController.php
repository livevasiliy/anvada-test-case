<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\API\V1\UpdateAPIDocument;
use App\Services\API\V1\DocumentApiService;
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Controllers\Controller;

/**
 * Class DocumentAPIController
 *
 * @package App\Http\Controllers\API\V1
 */
class DocumentAPIController extends Controller
{
    /** @var DocumentApiService */
    private $documentApiService;

    /**
     * DocumentAPIController constructor.
     *
     * @param DocumentApiService $documentApiService
     */
    public function __construct(DocumentApiService $documentApiService)
    {
        $this->documentApiService = $documentApiService;
    }


    /**
     * Display a listing of the resource.
     *
     * Показать список ресурсов.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->documentApiService->index($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * Создать новый ресурс в хранилище.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return $this->documentApiService->store($request);
    }

    /**
     * Display the specified resource.
     *
     * Показать указанный ресурс.
     *
     * @param string $document
     *
     * @return JsonResponse
     */
    public function show(string $document): JsonResponse
    {
        return $this->documentApiService->show($document);
    }

    /**
     * Update the specified resource in storage.
     *
     * Обновить указанный ресурс в хранилище.
     *
     * @param UpdateAPIDocument $request
     * @param string $document
     *
     * @return JsonResponse
     */
    public function update(UpdateAPIDocument $request, string $document): JsonResponse
    {
        return $this->documentApiService->update($request, $document);
    }

    /**
     * Update the specified resource to published.
     *
     * Опубликовать указанныый ресурс.
     *
     * @param string $document
     *
     * @return JsonResponse
     */
    public function publish(string $document): JsonResponse
    {
        return $this->documentApiService->publish($document);
    }
}
