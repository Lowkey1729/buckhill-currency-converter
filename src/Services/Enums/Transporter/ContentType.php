<?php

declare(strict_types=1);

namespace Mojeed\BuckhillCurrencyConverter\Services\Enums\Transporter;

use Spatie\Enum\Enum;

/**
 * @method static self JSON()
 * @method static self MULTIPART()
 * @method static self XML()
 * */
final class ContentType extends Enum
{
    /**
     * @return array<string, string>
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
