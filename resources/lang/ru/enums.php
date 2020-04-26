<?php

use App\Enums\DocumentStatus;

return [
    DocumentStatus::class => [
        DocumentStatus::DRAFT => 'Черновик',
        DocumentStatus::PUBLISHED => 'Опубликован'
    ]
];
