<?php

namespace App\Repositories\Currency;

use App\Values\CurrencyType;
use Exception;

class Factory
{
    protected array $repositories = [
        CurrencyType::Fiat->value => Factory::class.'::Fiat',
        CurrencyType::Crypto->value => Factory::class.'::Crypto',
    ];

    public function __construct(array $repositories = [])
    {
        $this->repositories = array_replace($this->repositories, $repositories);
    }

    public function for(CurrencyType $type): CurrencyRepository
    {
        return $this->repositories[$type->value]();
        throw new Exception("Currency Repository not found", 1);
    }
    
    public static function Fiat(): Fiat
    {
        return new Fiat();
    }

    public static function Crypto(): Crypto
    {
        return new Crypto();
    }
}