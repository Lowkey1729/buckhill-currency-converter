<?php

declare(strict_types=1);

namespace Mojeed\BuckhillCurrencyConverter\Services\Enums\Transporter;

use Spatie\Enum\Enum;

/**
 * @method static self PUT()
 * @method static self POST()
 * @method static self GET()
 * @method static self DELETE()
 * */
final class Method extends Enum
{
    /**
     * @return array<string, string>
     */
    public static function values(): array
    {
        return [
            'PUT' => 'PUT',
            'POST' => 'POST',
            'GET' => 'GET',
            'DELETE' => 'DELETE',
        ];
    }
}
