<?php

namespace Mojeed\BuckhillCurrencyConverter\Tests\Feature;

use Mojeed\BuckhillCurrencyConverter\Tests\TestCase;

class CurrencyConverterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan(
            'migrate',
            ['--database' => 'exchange_rates']
        );
        $this->artisan('buckhill:update-exchange-rates');
    }

    /**
     * @test
     */
    public function it_validates_convert_currency_request(): void
    {
        $this->json(
            "POST",
            route('convert.currency'),
            []
        )->assertStatus(422);
    }

    /**
     * @test
     */
    public function it_can_convert_currency(): void
    {
        $result = $this->json(
            "POST",
            route('convert.currency'),
            [
                'amount' => 200,
                'currency' => 'USD'
            ]
        )->assertStatus(200);
    }
}
