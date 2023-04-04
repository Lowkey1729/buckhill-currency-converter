<?php

namespace Mojeed\BuckhillCurrencyConverter\Services\Enums\Transporter;

use Spatie\Enum\Enum;

/**
 * @method static self PUT()
 * @method static self POST()
 * @method static self GET()
 * @method static self DELETE()
 * */
class Method extends Enum
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
