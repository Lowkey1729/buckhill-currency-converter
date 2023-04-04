<?php

declare(strict_types=1);

namespace Mojeed\BuckhillCurrencyConverter\Services\APIs;

use Exception;
use Mojeed\BuckhillCurrencyConverter\Contracts\CurrencyConverterContract;
use Mojeed\BuckhillCurrencyConverter\Contracts\Transporters\TransporterContract;
use Mojeed\BuckhillCurrencyConverter\Services\Enums\Transporter\ContentType;
use Mojeed\BuckhillCurrencyConverter\Services\Enums\Transporter\Method;
use Mojeed\BuckhillCurrencyConverter\Transporters\HttpTransporter;

final class EuropeanCentralBankRates implements CurrencyConverterContract
{
    protected TransporterContract $transporter;

    public function __construct()
    {
        $this->transporter = new HttpTransporter(
            'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml',
            ['Accept' => ContentType::XML()->value]
        );
    }

    /**
     * @throws Exception
     */
    public function fetchRates(): array
    {
        return $this->transporter->requestObject((string) Method::GET()->value);
    }
}
