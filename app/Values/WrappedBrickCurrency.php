<?php

namespace App\Values;

use Brick\Money\Currency as BrickCurrency;
use App\Values\Currency;

class WrappedBrickCurrency implements Currency
{
    protected BrickCurrency $brick;

    protected CurrencyType $type;

    public static function getBrickCurrency(Currency $currency): BrickCurrency
    {
        return new BrickCurrency(
            $currency->getCurrencyCode(),
            $currency->getNumericCode(),
            $currency->getName(),
            $currency->getDefaultFractionDigits()
        );
    }

    public function __construct(BrickCurrency $brick, CurrencyType $type = CurrencyType::Fiat) 
    {
        if($brick) {
            $this->brick = $brick;
        }
        $this->type = $type;
    }

    public function getWrapped(): BrickCurrency
    {
        return $this->brick;
    }

    public function getCurrencyCode(): string
    {
        return $this->brick->getCurrencyCode();
    }

    public function getNumericCode(): int
    {
        return $this->brick->getNumericCode();
    }

    public function getName(): string
    {
        return $this->brick->getName();
    }

    public function getDefaultFractionDigits(): int
    {
        return $this->brick->getDefaultFractionDigits();
    }

    public function getType(): CurrencyType
    {
        return $this->type;
    }

    public function is(Currency $currency): bool
    {
        return $this->type == $currency->getType() && 
               $this->getNumericCode() == $currency->getNumericCode();
    }
}