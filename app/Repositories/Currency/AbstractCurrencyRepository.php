<?php

namespace App\Repositories\Currency;

use App\Values\CurrencyType;

abstract class AbstractCurrencyRepository implements CurrencyRepository
{
    public const TYPE = CurrencyType::Fiat;

    public function getType(): CurrencyType
    {
        return self::TYPE;
    }
}