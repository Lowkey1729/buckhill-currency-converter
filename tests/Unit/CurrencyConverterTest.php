<?php

declare(strict_types=1);

namespace Mojeed\BuckhillCurrencyConverter\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Mojeed\BuckhillCurrencyConverter\Exceptions\ConverterError;
use Mojeed\BuckhillCurrencyConverter\Services\Actions\CurrencyConverter;
use Mojeed\BuckhillCurrencyConverter\Tests\TestCase;

class CurrencyConverterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan(
            'migrate',
            ['--database' => 'exchange_rates']
        );
        $this->artisan('buckhill:update-exchange-rates');
    }

    /**
     * @test
     *
     * @throws ConverterError
     */
    public function it_can_convert_currency(): void
    {
        $converter = resolve(CurrencyConverter::class);
        $result = $converter->convertCurrency(100, 'USD');
        $this->assertNotEmpty($result);
        $this->assertTrue(is_array($result));
        $this->assertArrayHasKey('converted_amount', $result);
    }

    /**
     * @test
     *
     * @throws ConverterError
     */
    public function it_throws_converter_error(): void
    {
        $this->expectException(ConverterError::class);
        $converter = resolve(CurrencyConverter::class);
        $converter->convertCurrency(100, 'INR09');
    }

    /**
     * @test
     *
     * @throws ConverterError
     */
    public function it_throws_converter_error_message_when_table_is_not_found(): void
    {
        $this->artisan('migrate:reset');
        $this->expectExceptionMessage('You have not published or ran the required migration');
        $converter = resolve(CurrencyConverter::class);
        $converter->convertCurrency(100, 'INR');
    }

    /**
     * @test
     *
     * @throws ConverterError
     */
    public function it_throws_converter_error_message_when_currency_is_not_found(): void
    {
        $this->expectExceptionMessage('Invalid currency selected');
        $converter = resolve(CurrencyConverter::class);
        $converter->convertCurrency(100, 'JJHOPP');
    }
}
