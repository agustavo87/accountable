<?php

namespace App\Values;

use App\Values\Currency;

interface Money
{
    public function setFromMinor(string $amount, Currency $currency);

    public function getMinorAmount(): string;

    public function getDecimalAmount(): string;

    public function getCurrencyNumber(): int;

    public function getCurrencyType(): CurrencyType;

    public function equals(Money $money): bool;

    public function getCurrency(): Currency;

    /**
     * @throws \App\Exceptions\MathException
     * @throws \App\Exceptions\MoneyException
     */
    public function plus(Money|string|int|float $amount, RoundingMode $rounding = RoundingMode::UNNECESSARY): Money;

    /**
     * @throws \App\Exceptions\MathException
     * @throws \App\Exceptions\MoneyException
     */
    public function minus(Money|string|int|float $amount, RoundingMode $rounding = RoundingMode::UNNECESSARY): Money;

    public function split(int $parts): array;

    public function allocate(...$proportions): array;
}