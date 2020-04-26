<?php


namespace App\Services\API\V1;


use App\Contracts\DocumentContract;
use App\Enums\DocumentStatus;
use App\Http\Requests\API\V1\UpdateAPIDocument;
use App\Http\Resources\{DocumentCollection, DocumentResource};
use Illuminate\Http\{JsonResponse, Request, Response};

/**
 * Class DocumentApiService
 *
 * @package App\Services\API\V1
 */
class DocumentApiService
{
    /** @var DocumentContract */
    private $documentRepository;

    /**
     * DocumentApiService constructor.
     *
     * @param DocumentContract $documentRepository
     *
     * @return void
     */
    public function __construct(DocumentContract $documentRepository)
    {
        $this->documentRepository = $documentRepository;
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
    final public function index(Request $request): JsonResponse
    {
        $perPage =  $request->perPage ? (int) $request->perPage : 15;
        $page = $request->page ? (int) $request->page : 1;

        $documents = new DocumentCollection($this->documentRepository->paginateDocuments($perPage, $page));

        return response()->json($documents, Response::HTTP_OK);
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
    final public function store(Request $request): JsonResponse
    {
        $document = $this->documentRepository->createDocument($request->all());

        /**
         * If the document was not found.
         *
         * Если документ не был найден.
         */
        if (!$document)
        {
            return response()->json([], Response::HTTP_BAD_REQUEST);
        }

        return response()->json($document, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * Показать указанный ресурс.
     *
     * @param string $uuid
     *
     * @return JsonResponse
     */
    final public function show(string $uuid): JsonResponse
    {
        $document = DocumentResource::make($this->documentRepository->findDocument($uuid));

        /**
         * If the document was not found.
         *
         * Если документ не был найден.
         */
        if (!$document)
        {
            return response()->json([], Response::HTTP_NOT_FOUND);
        }

        return response()->json($document, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * Обновить указанный ресурс в хранилище.
     *
     * @param UpdateAPIDocument $request
     * @param string $uuid
     *
     * @return JsonResponse
     */
    final public function update(UpdateAPIDocument $request, string $uuid): JsonResponse
    {
        $document = $this->documentRepository->findDocument($uuid);

        /**
         * If the document was not found.
         *
         * Если документ не был найден.
         */
        if (!$document)
        {
            return response()->json([], Response::HTTP_NOT_FOUND);
        }

        /**
         * If the document has status is published.
         *
         * Если документ уже имеет статус опубликован.
         */
        if (DocumentStatus::getInstance($document->status)->value === DocumentStatus::PUBLISHED)
        {
            return response()->json($document, Response::HTTP_BAD_REQUEST);
        }

        $document = DocumentResource::make($this->documentRepository->updateDocument(
                $uuid,
                $request->input('document.payload')
            )
        );

        /**
         * If a document error occurred while updating.
         *
         * Если произошла ошибка при обновлении документа.
         */
        if (!$document) {
            return response()->json($document, Response::HTTP_BAD_REQUEST);
        }

        return response()->json($document, Response::HTTP_OK);
    }

    /**
     * Update the specified resource to published.
     *
     * Опубликовать указанный ресурс.
     *
     * @param string $uuid
     *
     * @return JsonResponse
     */
    final public function publish(string $uuid): JsonResponse
    {
        $document = $this->documentRepository->findDocument($uuid);

        if (!$document)
        {
            return response()->json([], Response::HTTP_NOT_FOUND);
        }

        $document = DocumentResource::make($this->documentRepository->publishDocument($uuid));

        return response()->json($document, Response::HTTP_OK);
    }
}
