<?php

namespace Mojeed\BuckhillCurrencyConverter\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Mojeed\BuckhillCurrencyConverter\Exceptions\ConverterError;
use Mojeed\BuckhillCurrencyConverter\Services\Helpers\ApiResponse;
use Mojeed\BuckhillCurrencyConverter\Http\Requests\CurrencyConverterRequest;
use Mojeed\BuckhillCurrencyConverter\Services\Actions\CurrencyConverter;

class CurrencyConverterController
{
    public function __invoke(CurrencyConverterRequest $request, CurrencyConverter $currencyConverter): JsonResponse
    {
        try {
            $result = $currencyConverter->convertCurrency(
                $request->amount,
                $request->currency,
            );
            return ApiResponse::success(
                [
                    'currency' => $request->currency,
                    'primary_currency' => $request->primary_currency ?? 'EUR',
                    'amount' =>  $request->amount,
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
