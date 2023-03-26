<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected $casts = [
        'native_names' => 'array',
        'currencies' => 'array',
    ];

    public function iso_currencies(): BelongsToMany
    {
        return $this->belongsToMany(
            ISOCurrency::class,
            'country_currency',
            'country_code',
            'iso_currency_id',
            'code_alpha_2',
            'id',
        );
    }
}
