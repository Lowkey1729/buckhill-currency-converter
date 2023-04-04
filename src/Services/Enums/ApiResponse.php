<?php

declare(strict_types=1);

namespace Mojeed\BuckhillCurrencyConverter\Services\Enums;

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
