<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CryptoCurrency
 *
 * @property string $code Code of the cripto
 * @property string $name Name of the cripto
 * @method static \Illuminate\Database\Eloquent\Builder|CryptoCurrency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CryptoCurrency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CryptoCurrency query()
 * @method static \Illuminate\Database\Eloquent\Builder|CryptoCurrency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CryptoCurrency whereName($value)
 * @mixin \Eloquent
 */
class CryptoCurrency extends Model
{
    protected $guarded = [];

    public $timestamps = false;
}
