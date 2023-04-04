<?php

namespace Mojeed\BuckhillCurrencyConverter\Services;

use Illuminate\Support\Facades\DB;

class CurrencyConverter
{
    /**
     * @param float $amount
     * @param string $currency
     * @param string $primaryCurrency
     * @return array
     */
    public function convertCurrency(
        float  $amount,
        string $currency = 'EUR',
        string $primaryCurrency = 'EUR'
    ): array
    {
        $exchangeRate = DB::table('exchange_rates')
            ->where('currency', $currency)
            ->where('primary_currency', $primaryCurrency)
            ->first();

        if (!$exchangeRate) {
            return [
                'success' => false,
                'message' => 'Invalid currency selected',
                'data' => []
            ];
        }

        return [
            'success' => true,
            'message' => 'Currency converted successfully',
            'data' => [
                'currency' => $currency,
                'primary_currency' => $primaryCurrency,
                'amount' => $amount,
                'converted_amount' => $amount * $exchangeRate->rate
            ]
        ];
    }
}
