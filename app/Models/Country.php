<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Country
 *
 * @property string $alpha_code_2
 * @property string $alpha_code_3
 * @property string $numeric_code_3
 * @property string $common_name
 * @property string $oficial_name
 * @property array $native_names
 * @property array $currencies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ISOCurrency> $iso_currencies
 * @property-read int|null $iso_currencies_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereAlphaCode2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereAlphaCode3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCommonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereNativeNames($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereNumericCode3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereOficialName($value)
 * @mixin \Eloquent
 */
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
            'country_iso_currency',
            'country_code',
            'iso_currency_id',
            'alpha_code_2',
            'id',
        );
    }
}
