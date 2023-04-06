------
**Buckhill-Currency converter** is a tool to help convert amounts in Euros into available currencies.

- Olarewaju Mojeed: **[github.com/Lowkey1729](https://github.com/Lowkey1729)**

## Table of Contents

- [Get Started](#get-started)
- [Publish Assets](#publish-assets)
- [Run Migration](#run-migration)
- [Run Command](#run-command)
- [Usage](#usage)
- [Formatting](#formatting)
- [Testing](#testing)
- [PHPStan](#phpstan)

## Get Started

> **Requires [PHP 8.2+](https://php.net/releases/)**

First, install Buckhill-Currency Converter via the [Composer](https://getcomposer.org/) package manager:

```bash
composer require mojeed/buckhill-currency-converter --ignore-platform-reqs
```

Ensure that the `php-http/discovery` composer plugin is allowed to run or install a client manually if your project does
not already have a PSR-18 client integrated.

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

## Run Command

run the command below to populate the exchange_rates table

```php
php artisan buckhill:update-exchange-rates
```

## Usage

View the swagger documentation (**currency-converted**) section for more info

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


