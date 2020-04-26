<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static DRAFT()
 * @method static static PUBLISHED()
 */
final class DocumentStatus extends Enum implements LocalizedEnum
{
    public const DRAFT =   'draft';
    public const PUBLISHED =  'published';
}
