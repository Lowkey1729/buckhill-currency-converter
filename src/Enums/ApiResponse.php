<?php

namespace Mojeed\BuckhillCurrencyConverter\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self success()
 * @method static self failed()
 * */
final class ApiResponse extends Enum
{
    /**
     * @return int[]
     */
    public static function values(): array
    {
        return [
            'success' => 1,
            'failed' => 0,
        ];
    }
}
