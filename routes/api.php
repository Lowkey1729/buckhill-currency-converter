<?php

use Illuminate\Support\Facades\Route;
use Mojeed\BuckhillCurrencyConverter\Http\Controllers\CurrencyConverterController;

Route::group(['prefix' => 'api/v1'], function () {
    Route::prefix('currency')->group(function () {
        Route::post('convert', CurrencyConverterController::class)
            ->name('convert.currency');
    });
});
