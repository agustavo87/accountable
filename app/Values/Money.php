<?php

namespace App\Values;

use Brick\Money\Money as BrickMoney;
use App\Values\CurrencyContract as Currency;
use Brick\Money\AbstractMoney;
use Brick\Money\RationalMoney;
use Stringable;

class Money implements Stringable
{
    protected BrickMoney|RationalMoney $money;
    protected BrickWrapperCurrency $currency;

    public function __construct(BrickMoney|RationalMoney|null $money = null, ?BrickWrapperCurrency $currency = null)
    {
        if($money) {
            $this->currency = $currency ?? new BrickWrapperCurrency($money->getCurrency());
            $this->money = $money;
        }
    }

    public function setFromMinor(string $amount, Currency|BrickWrapperCurrency $currency)
    {
        if( is_a($currency, BrickWrapperCurrency::class) ) {
            $brickCurrency = $currency->getWrapped();
        } else {
            $brickCurrency = BrickWrapperCurrency::getBrickCurrency($currency);
        }
        $this->money = BrickMoney::ofMinor($amount, $brickCurrency);
        $this->currency = $currency;
    }

    public function getMinorAmount(): string
    {
        return $this->money->getMinorAmount()->toBigInteger()->__toString();
    }

    public function getCurrencyNumber(): int
    {
        return $this->currency->getNumericCode();
    }

    public function getCurrencyType(): CurrencyType
    {
        return $this->currency->getType();
    }

    public function equals(Money $money): bool
    {
        if($money->getCurrencyType() != $this->getCurrencyType()) {
            return false;
        }
        return $this->money->isEqualTo($money->getWrapped());
    }

    public function getWrapped(): BrickMoney
    {
        return $this->money;
    }

    public function getCurrency(): Currency|BrickWrapperCurrency
    {
        return $this->currency;
    }

    public function __call($name, $arguments)
    {
        $arguments = array_map(
            fn($arg) => $arg instanceof Money ? $arg->getWrapped() : $arg,
            $arguments
        );
        // info($name, $arguments);
        $result = $this->money->$name(...$arguments);
        if($result instanceof AbstractMoney) {
            return new static($result, $this->currency);
        }
        return $result;
    }

    public function __toString(): string
    {
        return $this->money->__toString();
    }
}