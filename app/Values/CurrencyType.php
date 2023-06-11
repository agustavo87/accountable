<?php

namespace App\Values;

enum CurrencyType: int
{
    case Fiat = 1;
    case Crypto = 2;
    case Custom = 3;
}