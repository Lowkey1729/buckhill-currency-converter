<?php

namespace Mojeed\BuckhillCurrencyConverter\Http\Requests;

use Mojeed\BuckhillCurrencyConverter\Services\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

/**
 * @property mixed $amount
 * @property mixed $currency
 */
class CurrencyConverterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric'],
            'currency' => ['required', 'string', 'size:3'],
            'primary_currency' => ['nullable', Rule::in(['EUR'])]
        ];
    }

    /**
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ApiResponse::failed(
                $validator->errors()->first(),
                $validator->errors()->toArray(),
                httpStatusCode: 422
            )
        );
    }
}
