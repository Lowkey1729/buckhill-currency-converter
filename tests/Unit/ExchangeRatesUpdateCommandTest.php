<?php


use Illuminate\Console\Application;
use Mojeed\BuckhillCurrencyConverter\Tests\TestCase;
use Mojeed\BuckhillCurrencyConverter\Providers\BuckhillCurrencyConverterServiceProvider;

class ExchangeRatesUpdateCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate',
            ['--database' => 'exchange_rates'])->run();

    }

    /**
     * @test
     * **/
    public function it_can_update_db_rates(): void
    {
        $this->artisan('buckhill:update-exchange-rates')
            ->assertOk();

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