<?php

namespace Mojeed\BuckhillCurrencyConverter\Concerns;

use Illuminate\Validation\Rule;

trait ConvertCurrencyRules
{
    protected function rules(): array
    {
        return [
            'amount' => ['required', 'numeric'],
            'currency' => ['required', 'string', 'size:3'],
            'primary_currency' => ['nullable', Rule::in(['EUR'])]
        ];
    }
}
