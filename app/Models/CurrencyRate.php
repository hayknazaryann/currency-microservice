<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'request_id',
        'title',
        'num_code',
        'char_code',
        'units',
        'rate',
        'inverse_rate',
    ];
}
