<?php

namespace App\Repositories\Currency;

use App\Values\BrickWrapperCurrency;
use App\Values\CurrencyContract as Currency;
use Brick\Money\Currency as BrickCurrency;

class Fiat implements Contract
{
    public function getByNumber(int $code): Currency|BrickWrapperCurrency
    {
        return new BrickWrapperCurrency(BrickCurrency::of($code));
    }
}