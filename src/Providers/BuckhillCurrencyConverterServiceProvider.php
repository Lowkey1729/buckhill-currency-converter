<?php

declare(strict_types=1);

namespace Mojeed\BuckhillCurrencyConverter\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Mojeed\BuckhillCurrencyConverter\Console\Commands\UpdateExchangeRates;
use Mojeed\BuckhillCurrencyConverter\Services\APIs\EuropeanCentralBankRates;

final class BuckhillCurrencyConverterServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(EuropeanCentralBankRates::class, function () {
            return new EuropeanCentralBankRates();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->registerMigrations()
                ->registerCommands()
                ->registerRoutes();
        }

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('buckhill:update-exchange-rates')->daily();
        });
    }

    protected function registerMigrations(): self
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        return $this;
    }

    protected function registerCommands(): self
    {
        $this->commands([
            UpdateExchangeRates::class,
        ]);
        return $this;
    }

    protected function registerRoutes(): self
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        return $this;
    }
}
