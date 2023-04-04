<?php

use Mojeed\BuckhillCurrencyConverter\Services\APIs\EuropeanCentralBankRates;
use Mojeed\BuckhillCurrencyConverter\Tests\TestCase;

class EuropeanBankRatesAPITest extends TestCase
{
    /**
     * @test
     *
     * @throws Exception
     */
    public function _it_can_process_rates_request(): void
    {
        $converter = resolve(EuropeanCentralBankRates::class);
        $result = $converter->fetchRates();
        $this->assertArrayHasKey(0, $result['data']);
    }
}
