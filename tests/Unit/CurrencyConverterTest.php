<?php

use Illuminate\Foundation\Application;
use Mojeed\BuckhillCurrencyConverter\Providers\BuckhillCurrencyConverterServiceProvider;
use Mojeed\BuckhillCurrencyConverter\Services\APIs\EuropeanCentralBankRates;
use Mojeed\BuckhillCurrencyConverter\Services\CurrencyConverter;
use Mojeed\BuckhillCurrencyConverter\Tests\TestCase;

class CurrencyConverterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate',
            ['--database' => 'exchange_rates'])->run();
        $this->artisan('buckhill:update-exchange-rates')
            ->assertOk();

    }

    /**
     * @test
     * **/
    public function it_can_convert_currency(): void
    {
        Mockery::mock(CurrencyConverter::class)
            ->shouldReceive('convertCurrency')
            ->andReturn([
                'USD' => 1.0875
            ]);
        $converter = resolve(CurrencyConverter::class);
        $result = $converter->convertCurrency(100);
        self::assertNotEmpty($result);
        self::assertIsArray($result['data']);

    }

    /**
     * Define environment setup.
     *
     * @param Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'exchange_rates');
        $app['config']->set('database.connections.exchange_rates', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * add the package provider
     *
     * @param $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [BuckhillCurrencyConverterServiceProvider::class];
    }

}
