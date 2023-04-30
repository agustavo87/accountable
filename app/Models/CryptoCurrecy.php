<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CryptoCurrecy
 *
 * @property string $code
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|CryptoCurrecy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CryptoCurrecy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CryptoCurrecy query()
 * @method static \Illuminate\Database\Eloquent\Builder|CryptoCurrecy whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CryptoCurrecy whereName($value)
 * @mixin \Eloquent
 */
class CryptoCurrecy extends Model
{
    protected $guarded = [];

    public $timestamps = false;
}
