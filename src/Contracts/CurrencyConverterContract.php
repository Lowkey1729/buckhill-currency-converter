<?php

declare(strict_types=1);

namespace Mojeed\BuckhillCurrencyConverter\Contracts;

interface CurrencyConverterContract
{
    public function fetchRates(): array;
}
