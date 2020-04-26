<?php

namespace App\Models;

use App\Enums\DocumentStatus;
use App\Models\Concerns\UsesUuid;
use BenSampo\Enum\Traits\CastsEnums;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\{Builder, Model};
use Illuminate\Support\Carbon;


/**
 * @package App\Models\Document
 *
 * @property string $id
 * @property string $status
 * @property array $payload
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @method static Builder|Document newModelQuery()
 * @method static Builder|Document newQuery()
 * @method static Builder|Document query()
 * @method static Builder|Document whereCreatedAt($value)
 * @method static Builder|Document whereId($value)
 * @method static Builder|Document wherePayload($value)
 * @method static Builder|Document whereStatus($value)
 * @method static Builder|Document whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Document extends Model
{
    use CastsEnums;
    use UsesUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'id' => 'string',
        'payload' => 'object',
        'status' => 'string'
    ];

    /**
     * The attribute that should be cast the used enum.
     *
     * @var string[]
     */
    protected $enumCasts = [
        'status' => DocumentStatus::class
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'payload',
        'status'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var string[]
     */
    protected $attributes = [
        'payload' => '{}'
    ];
}
