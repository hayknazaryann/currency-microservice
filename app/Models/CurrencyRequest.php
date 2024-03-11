<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CurrencyRequest extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'date'
    ];

    /**
     * @return HasMany
     */
    public function rates(): HasMany
    {
        return $this->hasMany(CurrencyRate::class, 'request_id');
    }
}
