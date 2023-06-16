<?php

namespace App\Repositories\Currency;

use App\Values\Currency;
use App\Values\CurrencyType;

interface CurrencyRepository
{
    public function getByNumber(int $code): Currency;

    public function get(string $code): Currency;

    public function getType(): CurrencyType;
}