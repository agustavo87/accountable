<?php

namespace App\Values;

interface CurrencyContract
{
    public function getCurrencyCode(): string;

    public function getNumericCode(): int;

    public function getName(): string;

    public function getDefaultFractionDigits(): int;

    public function getType(): CurrencyType;
}