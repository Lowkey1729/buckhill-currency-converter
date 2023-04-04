<?php

declare(strict_types=1);

namespace Mojeed\BuckhillCurrencyConverter\Services\Helpers;

use Illuminate\Http\JsonResponse;
use Mojeed\BuckhillCurrencyConverter\Services\Enums\ApiResponse as ApiResponseEnum;

final class ApiResponse
{
    /**
     * @param array|object $data
     * @param array $extraData
     * @param int $httpStatusCode
     * @return JsonResponse
     */
    public static function success(
        array|object $data = [],
        array $extraData = [],
        int $httpStatusCode = 200
    ): JsonResponse {
        return \response()->json([
            'success' => ApiResponseEnum::success()->value,
            'data' => $data,
            'error' => null,
            'errors' => [],
            'extra' => $extraData,

        ], $httpStatusCode);
    }


    /**
     * @param string $errorMessage
     * @param array $data
     * @param array $errors
     * @param array $errorTrace
     * @param int $httpStatusCode
     * @return JsonResponse
     */
    public static function failed(
        string $errorMessage,
        array $data = [],
        array $errors = [],
        array $errorTrace = [],
        int $httpStatusCode = 200
    ): JsonResponse {
        return \response()->json([
            'success' => ApiResponseEnum::failed()->value,
            'data' => $data,
            'error' => $errorMessage,
            'errors' => $errors,
            'trace' => $errorTrace,
        ], $httpStatusCode);
    }
}
