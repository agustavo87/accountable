<?php

namespace App\Repositories\Currency;

use App\Models\User;
use App\Values\CurrencyType;
use Exception;

class Factory
{
    protected array $repositories = [
        CurrencyType::Fiat->value => Factory::class.'::Fiat',
        CurrencyType::Crypto->value => Factory::class.'::Crypto',
        CurrencyType::Custom->value => Factory::class.'::Custom',
    ];

    public function __construct(array $repositories = [])
    {
        $this->repositories = array_replace($this->repositories, $repositories);
    }

    public function for(CurrencyType $type, $params = []): CurrencyRepository
    {
        return $this->repositories[$type->value](...$params);
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

    public static function Custom(User $user = null): Custom
    {
        return new Custom($user);
    }
}