<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CurrencyInterface extends EloquentInterface
{
    /**
     * @param string $date
     * @return Model|null
     */
    public function findByDate(string $date): ?Model;

    /**
     * @param string $startDate
     * @param string $endDate
     * @return Collection
     */
    public function findByPeriod(string $startDate, string $endDate): Collection;
}
