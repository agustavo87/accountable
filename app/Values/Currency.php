<?php

namespace App\Values;

interface Currency
{
    public function getCurrencyCode(): string;

    public function getNumericCode(): int;

    public function getName(): string;

    public function getDefaultFractionDigits(): int;

    public function getType(): CurrencyType;

    public function is(Currency $currency): bool;
}