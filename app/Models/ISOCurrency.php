<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ISOCurrency extends Model
{
    protected $table = 'iso_currencies';

    protected $guarded = [];

    public $timestamps = false;

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(
            Country::class,
            'country_iso_currency',
            'iso_currency_code',
            'country_code',
            'code',
            'alpha_code_2',
        );
    }
}
