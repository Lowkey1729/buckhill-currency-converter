<?php

namespace Mojeed\BuckhillCurrencyConverter\Services\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Mojeed\BuckhillCurrencyConverter\Exceptions\ConverterError;

class CurrencyConverter
{
    /**
     * @param float $amount
     * @param string $currency
     * @param string $primaryCurrency
     * @return array
     * @throws ConverterError
     */
    public function convertCurrency(
        float  $amount,
        string $currency = 'EUR',
        string $primaryCurrency = 'EUR'
    ): array {
        if (!Schema::hasTable('exchange_rates')) {
            throw new ConverterError(
                'You have not published or ran the required migration',
                500
            );
        }
        $exchangeRate = DB::table('exchange_rates')
            ->where('currency_to_exchange', $currency)
            ->where('primary_currency', $primaryCurrency)
            ->first();

        if (!$exchangeRate) {
            throw new ConverterError('Invalid currency selected.', 404);
        }

        return [
            'converted_amount' => $amount * $exchangeRate->rate,
            'rate' => $exchangeRate->rate
        ];
    }

    /**
     * @param Request $request
     * @return Collection
     * @throws ConverterError
     */
    public function currencyRatesList(Request $request): Collection
    {
        if (!Schema::hasTable('exchange_rates')) {
            throw new ConverterError(
                'You have not published or ran the required migration',
                500
            );
        }

        return DB::table('exchange_rates')
            ->get();
    }
}
