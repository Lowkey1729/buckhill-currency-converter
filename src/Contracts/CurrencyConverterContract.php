<?php

namespace Mojeed\BuckhillCurrencyConverter\Contracts;

interface CurrencyConverterContract
{
    public function fetchRates(): array;
}
