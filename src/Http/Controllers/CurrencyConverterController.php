<?php

namespace Mojeed\BuckhillCurrencyConverter\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mojeed\BuckhillCurrencyConverter\Exceptions\ConverterError;
use Mojeed\BuckhillCurrencyConverter\Concerns\ConvertCurrencyRules;
use Mojeed\BuckhillCurrencyConverter\Helpers\ApiResponse;
use Mojeed\BuckhillCurrencyConverter\Services\Actions\CurrencyConverter;

class CurrencyConverterController
{
    use ConvertCurrencyRules;


    /**
     * @param Request $request
     * @param CurrencyConverter $currencyConverter
     * @return JsonResponse
     */
    public function __invoke(Request $request, CurrencyConverter $currencyConverter): JsonResponse
    {
        $validated = $request->validate($this->rules());
        try {
            $result = $currencyConverter->convertCurrency(
                $validated['amount'],
                $validated['currency'],
            );
            return ApiResponse::success(
                [
                    'currency' => $validated['currency'],
                    'primary_currency' => $validated['primary_currency'] ?? 'EUR',
                    'amount' => $validated['amount'],
                    'converted_amount' => $result['converted_amount'],
                    'rate' => $result['rate']
                ]
            );
        } catch (ConverterError $exception) {
            return ApiResponse::failed(
                $exception->getMessage(),
                httpStatusCode: $exception->getCode()
            );
        }
    }
}
