<?php

namespace App\Repositories\Currency;

use App\Values\{Currency, CurrencyType, WrappedBrickCurrency};
use Brick\Money\Currency as BrickCurrency;

class Fiat extends AbstractCurrencyRepository
{
    public const TYPE = CurrencyType::Fiat;

    public function getByNumber(int $code): Currency|WrappedBrickCurrency
    {
        return new WrappedBrickCurrency(BrickCurrency::of($code));
    }

    public function get(string $code): Currency|WrappedBrickCurrency
    {
        return new WrappedBrickCurrency(BrickCurrency::of($code));
    }
}