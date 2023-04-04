<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1'], function () {
    Route::get('convert/currency', [])
        ->name('convert.currency');
});
