<?php

namespace Mojeed\BuckhillCurrencyConverter\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Mojeed\BuckhillCurrencyConverter\Services\APIs\EuropeanCentralBankRates;

final class UpdateExchangeRates extends Command
{
    protected $signature = 'buckhill:update-exchange-rates';

    protected $description = 'Update the currency rate for each primary currency.';

    /**
     * @return int
     * @throws Exception
     */
    public function handle(): int
    {
        if ($this->tableExistsInTheDB('exchange_rates')) {
            DB::table('exchange_rates')->truncate();
            $exchangeRates = $this->getExchangeRates();
            $currencyRate = [];
            $this->loadCurrencyRate($exchangeRates['data'], $currencyRate);
            DB::table('exchange_rates')->insert($currencyRate);

            $this->info('Exchange rates updated successfully!');
        }


        return 0;
    }

    /**
     * @param array $exchangeRates
     * @param array $currencyRate
     * @return void
     */
    protected function loadCurrencyRate(
        array $exchangeRates,
        array &$currencyRate
    ): void {
        foreach ($exchangeRates as $key => $exchangeRate) {
            $currencyRate[] = [
                'currency_to_exchange' => $exchangeRate['@attributes']['currency'],
                'rate' => $exchangeRate['@attributes']['rate'],
                'primary_currency' => 'EUR'

            ];
        }
    }

    /**
     * @return array
     * @throws Exception
     */
    protected function getExchangeRates(): array
    {
        /* @var  EuropeanCentralBankRates $service */
        $service = resolve(EuropeanCentralBankRates::class);
        return $service->fetchRates();
    }

    protected function tableExistsInTheDB(string $tableName): bool
    {
        return Schema::hasTable($tableName);
    }
}
