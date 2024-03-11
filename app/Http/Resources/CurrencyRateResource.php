<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyRateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'num_code' => $this->num_code,
            'char_code' => $this->char_code,
            'units' => $this->units,
            'title' => $this->title,
            'rate' => $this->rate,
            'inverse_rate' => $this->inverse_rate,
        ];
    }
}
