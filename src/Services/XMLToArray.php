<?php

namespace Mojeed\BuckhillCurrencyConverter\Services;

use Psr\Http\Message\StreamInterface;

class XMLToArray
{
    public static function make(StreamInterface $xmlBody): array
    {
        $xmlBody = simplexml_load_string($xmlBody);
        return json_decode(json_encode($xmlBody), true);
    }
}
