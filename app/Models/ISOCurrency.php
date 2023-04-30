<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * ISO 4217 Currency codes
 * https://www.iso.org/iso-4217-currency-codes.html
 *
 * @property int $id
 * @property string $code
 * @property string $number
 * @property string $name
 * @property int $minor_units
 * @property string $country_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Country> $countries
 * @property-read int|null $countries_count
 * @method static \Illuminate\Database\Eloquent\Builder|ISOCurrency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ISOCurrency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ISOCurrency query()
 * @method static \Illuminate\Database\Eloquent\Builder|ISOCurrency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ISOCurrency whereCountryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ISOCurrency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ISOCurrency whereMinorUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ISOCurrency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ISOCurrency whereNumber($value)
 * @mixin \Eloquent
 */
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
