<?php

namespace App\Repositories\Currency;

use App\Values\CurrencyType;

class Factory
{
    public function for(CurrencyType $type): CurrencyRepository
    {
        if ($type == CurrencyType::Fiat) {
            return new Fiat();
        }
    }
}