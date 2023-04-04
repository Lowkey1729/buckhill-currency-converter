<?php

namespace Mojeed\BuckhillCurrencyConverter\Enums\Transporter;

use Spatie\Enum\Enum;

/**
 * @method static self JSON()
 * @method static self MULTIPART()
 * @method static self XML()
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
            'XML' => 'application/xml'
        ];
    }
}
