<?php

namespace App\Repositories\Eloquent;

use App\Models\CurrencyRequest;
use App\Repositories\Interfaces\CurrencyInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CurrencyRepository extends EloquentRepository implements CurrencyInterface
{
    /**
     * CurrencyRepository constructor.
     * @param CurrencyRequest $currencyRequest
     */
    public function __construct(CurrencyRequest $currencyRequest)
    {
        $this->model = $currencyRequest;
    }

    /**
     * @inheritDoc
     */
    public function findByDate(string $date): ?Model
    {
        return $this->getModel()->query()->whereDate('date', $date)->first();
    }

    /**
     * @inheritDoc
     */
    public function findByPeriod(string $startDate, string $endDate): Collection
    {
        return $this->getModel()->query()->whereBetween('date', [$startDate, $endDate])->get();
    }


    /**
     * @inheritDoc
     */
    public function create(array $data): Model
    {
        $createdRequest = $this->getModel()->query()->create(
            [
                'title' => $data['title'],
                'date' => $data['date']
            ]
        );

        $createdRequest->rates()->createMany($data['rates']);
        return $createdRequest;
    }


}
