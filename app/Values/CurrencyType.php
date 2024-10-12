<?php

namespace App\Values;

enum CurrencyType: int
{
    case Fiat = 1;
    case Crypto = 2;
    case Custom = 3;

    public function stringCode(): string
    {
        return match ($this->value) {
            1 => 'fiat',
            2 => 'crypto',
            3 => 'custom',
        };
    }

    public static function fromStringCode(string $code): static
    {
        return match ($code) {
            'fiat' => static::Fiat,
            'crypto' => static::Crypto,
            'custom' => static::Custom,
        };
    }

}