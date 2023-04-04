<?php

declare(strict_types=1);

namespace Mojeed\BuckhillCurrencyConverter\Services\Helpers;

final class XMLToArray
{
    /**
     * @param string $xmlBody
     * @return array
     */
    public static function make(string $xmlBody): array
    {
        $xmlBody = simplexml_load_string($xmlBody);
        $encodedXMLBody = json_encode($xmlBody);
        if ($encodedXMLBody === false) {
            throw new \RuntimeException('Unable to decode body');
        }
        return json_decode($encodedXMLBody, true);
    }
}
