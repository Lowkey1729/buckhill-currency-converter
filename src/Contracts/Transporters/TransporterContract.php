<?php

namespace Mojeed\BuckhillCurrencyConverter\Contracts\Transporters;

interface TransporterContract
{
    /**
     * Sends a request to a server.
     **
     * @param array $payload
     * @param string $method
     * @return array
     */
    public function requestObject(string $method, array $payload = []): array;
}
