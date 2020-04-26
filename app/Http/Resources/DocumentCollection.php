<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DocumentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'document' => $this->collection,
            'pagination' => [
                'page' => $this->currentPage(),
                'perPage' => $this->perPage(),
                'total' => $this->total()
            ]
        ];
    }

    public function withResponse($request, $response)
    {
        $original = $response->getOriginalContent();
        unset($original['links'], $original['meta']);
        $response->setContent($original);
    }
}
