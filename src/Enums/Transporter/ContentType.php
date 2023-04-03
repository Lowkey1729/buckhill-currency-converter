<?php

namespace Mojeed\BuckhillCurrencyConverter\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self JSON()
 * @method static self MULTIPART()
 * */
class ContentType extends Enum
{
    /**
     * @return int[]
     */
    public static function values(): array
    {
        return [
            'JSON' => 'application/json',
            'MULTIPART' => 'multipart/form-data',
        ];
    }
}
