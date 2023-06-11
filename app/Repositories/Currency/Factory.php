<?php

namespace App\Repositories\Currency;

use App\Values\CurrencyType;

class Factory
{
    public function for(CurrencyType $type)
    {
        if ($type == CurrencyType::Fiat) {
            return new Fiat();
        }
    }
}