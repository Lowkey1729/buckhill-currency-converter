<?php

declare(strict_types=1);

namespace Mojeed\BuckhillCurrencyConverter\Services\Concerns;

use GuzzleHttp\Client;

trait Transportable
{
    protected Client $client;

    /**
     * Creates a new Http Transporter instance.
     */
    public function __construct(
        private readonly string $uri,
        private readonly array $headers = [],
    ) {
        $this->client = new Client(
            ['headers' => $this->headers]
        );
    }
}
