<?php

namespace Mojeed\BuckhillCurrencyConverter\Tests\Unit;

use Mojeed\BuckhillCurrencyConverter\Tests\TestCase;

class ExchangeRatesUpdateCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan(
            'migrate',
            ['--database' => 'exchange_rates']
        )->run();
    }

    /**
     * @test
     * **/
    public function it_can_update_db_rates(): void
    {
        $this->artisan('buckhill:update-exchange-rates')
            ->assertOk();
    }
}
