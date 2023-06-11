<?php

namespace App\Repositories\Currency;

use App\Values\CurrencyContract as Currency;

interface Contract
{
    public function getByNumber(int $code): Currency;
}