<?php

namespace Mojeed\BuckhillCurrencyConverter\Services;

use Psr\Http\Message\StreamInterface;

class XMLToArray
{
    /**
     * @param StreamInterface $xmlBody
     * @return array
     */
    public static function make(StreamInterface $xmlBody): array
    {
        $xmlBody = simplexml_load_string($xmlBody);
        $encodedXMLBody = json_encode($xmlBody);
        if ($encodedXMLBody === false) {
            throw new \RuntimeException("Unable to decode body");
        }
        return json_decode($encodedXMLBody, true);
    }
}
