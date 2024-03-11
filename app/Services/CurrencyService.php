<?php

namespace App\Services;

use App\Http\Resources\CurrencyRequestResource;
use App\Repositories\Interfaces\CurrencyInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CurrencyService
{
    /**
     * @param RequestService $requestService
     * @param CurrencyInterface $currencyRepository
     */
    public function __construct(
        protected RequestService $requestService,
        protected CurrencyInterface $currencyRepository
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function cbrDailyRates(): JsonResponse
    {
        try {
            DB::beginTransaction();

            $date = Carbon::now('Europe/Moscow');

            if ($existingData = $this->currencyRepository->findByDate($date->format('Y-m-d'))) {
                $currencyRequest = $existingData;
            } else {
                $xmlResponseData = $this->requestService->sendXmlRequest(
                    url: config('services.cbr.url'),
                    date: $date->format('d/m/Y')
                );

                $data = $this->prepareData($xmlResponseData, $date->format('Y-m-d'));

                $currencyRequest = $this->currencyRepository->create(
                    data: $data
                );
            }

            DB::commit();

            return Response::json(
                data: new CurrencyRequestResource($currencyRequest),
                options: JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::json(
                data: [
                    'error' => 'Failed to retrieve currency rates.'
                ],
                status: 500
            );
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function cbrRatesForPeriod(Request $request): JsonResponse
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $data = $this->currencyRepository->findByPeriod(
            startDate: $startDate,
            endDate: $endDate
        );

        return Response::json(
            data: CurrencyRequestResource::collection($data),
            options: JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * @param array $xmlResponseData
     * @param string $date
     * @return array
     */
    private function prepareData(array $xmlResponseData, string $date): array
    {
        $title = $xmlResponseData['@attributes']['name'];

        $data = [
            'title' => $title,
            'date' => $date
        ];

        $rates = [];
        foreach ($xmlResponseData['Valute'] as $valute) {
            $rates[] = [
                'title' => $valute['Name'],
                'num_code' => $valute['NumCode'],
                'char_code' => $valute['CharCode'],
                'units' => $valute['Nominal'],
                'rate' => (float)str_replace(',', '.', $valute['Value']),
                'inverse_rate' => (float)str_replace(',', '.', $valute['VunitRate']),
            ];
        }
        $data['rates'] = $rates;

        return $data;
    }


}
