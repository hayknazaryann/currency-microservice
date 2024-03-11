<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CurrencyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="Currency Rates API",
 *         version="1.0",
 *     )
 * )
 */
class CurrencyController extends Controller
{
    /**
     * @param CurrencyService $currencyService
     */
    public function __construct(
        protected CurrencyService $currencyService
    )
    {
    }

    /**
     * @OA\Get(
     *     path="/api/cbr/currency-rates/daily",
     *     summary="Get the CBR Daily rates",
     *     @OA\Response(response="200", description="Success", @OA\JsonContent()),
     * )
     * @return JsonResponse
     */
    public function getCurrencyDailyRates(): JsonResponse
    {
        return $this->currencyService->cbrDailyRates();
    }

    /**
     * @OA\Get(
     *     path="/api/cbr/currency-rates/period",
     *     summary="Get currency rates for a specified period",
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         required=true,
     *         description="Start date of the period (YYYY-MM-DD)",
     *         @OA\Schema(type="string", format="date", example="2024-03-01")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         required=true,
     *         description="End date of the period (YYYY-MM-DD)",
     *         @OA\Schema(type="string", format="date", example="2024-03-10")
     *     ),
     *     @OA\Response(response="200", description="Success", @OA\JsonContent()),
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getCurrencyRatesForPeriod(Request $request): JsonResponse
    {
        return $this->currencyService->cbrRatesForPeriod(
            request: $request
        );
    }
}
