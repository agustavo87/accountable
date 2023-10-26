<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ISOCurrency extends Model
{
    protected $table = 'iso_currencies';

    protected $guarded = [];

    public $timestamps = false;
}
