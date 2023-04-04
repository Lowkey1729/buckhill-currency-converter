------
**Buckhill-Currency converter** is a tool to help convert amounts in available currencies into Euros.

- Olarewaju Mojeed: **[github.com/Lowkey1729](https://github.com/Lowkey1729)**

## Table of Contents
- [Get Started](#get-started)
- [Publish Assets](#publish-assets)
- [Run Migration](#run-migration)
- [Formatting](#formatting)
- [Testing](#testing)
- [PHPStan](#phpstan)

## Get Started

> **Requires [PHP 8.2+](https://php.net/releases/)**

First, install Buckhill-Currency Converter via the [Composer](https://getcomposer.org/) package manager:

```bash
composer require mojeed/buckhill-currency-converter
```

Ensure that the `php-http/discovery` composer plugin is allowed to run or install a client manually if your project does not already have a PSR-18 client integrated.
```bash
composer require guzzlehttp/guzzle
```

## Publish Assets

```php
php artisan vendor:publish --provider "Mojeed\BuckhillCurrencyConverter\Providers\BuckhillCurrencyConverterServiceProvider"
```

## Run Migration
After publishing the assets, run the migration using the command below.
This is to create the "exchange_rates" table
```php
php artisan migrate
```
## Formatting
To run the PSR12 format test, run
```bash
composer pint
```

## Testing
To run tests, run
```bash
composer test
```

## PHPStan
To run PHP stan, run
```bash
composer analyse
```


