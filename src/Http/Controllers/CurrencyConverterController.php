<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Mojeed\BuckhillCurrencyConverter\Concerns\ConvertCurrencyRules;
use Mojeed\BuckhillCurrencyConverter\Helpers\ApiResponse;
use Mojeed\BuckhillCurrencyConverter\Services\CurrencyConverter;

class CurrencyConverterController
{
    use ConvertCurrencyRules;


    public function __invoke(Request $request, CurrencyConverter $currencyConverter)
    {
        $validated = $request->validate($this->rules());
        if (!Schema::hasTable('exchange_rates')) {
            return ApiResponse::failed("You haven't published or ran the required migration");
        }
        $response = $currencyConverter->convertCurrency(
            $validated['amount'],
            $validated['currency'],
        );
        return ApiResponse::success($response['data']);
    }
}
