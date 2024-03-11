<?php

use App\Http\Controllers\Api\CurrencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('cbr/currency-rates')->group(function () {
    Route::get('daily', [CurrencyController::class, 'getCurrencyDailyRates']);
    Route::get('period', [CurrencyController::class, 'getCurrencyRatesForPeriod']);
});
