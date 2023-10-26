<?php

namespace App\Values;

use App\Exceptions\MathException;
use App\Exceptions\MoneyException;
use App\Exceptions\MoneyMismatchException;
use App\Exceptions\RoundingNecessaryException;
use Brick\Money\Money as BrickMoney;
use App\Values\Currency;

/**
 * A Money implementation that works wrapping a Brick Money Instance
 */
class BrickMoneyWrapperMoney extends BrickMoneyWrapper implements Money
{
    public function setFromMinor(string $amount, Currency|WrappedBrickCurrency $currency)
    {
        if($currency instanceof WrappedBrickCurrency) {
            $brickCurrency = $currency->getWrapped();
        } else {
            $brickCurrency = WrappedBrickCurrency::getBrickCurrency($currency);
        }
        $this->money = BrickMoney::ofMinor($amount, $brickCurrency);
        $this->currency = $currency;
    }

    public function setFromDecimal(string|int $amount, Currency|WrappedBrickCurrency $currency, RoundingMode $rounding = RoundingMode::UNNECESSARY )
    {
        if($currency instanceof WrappedBrickCurrency) {
            $brickCurrency = $currency->getWrapped();
        } else {
            $brickCurrency = WrappedBrickCurrency::getBrickCurrency($currency);
        }
        $this->money = BrickMoney::of(
            amount:$amount, 
            currency:$brickCurrency, 
            roundingMode:$rounding->value
        );
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

    public function equals(Money|BrickMoneyWrapperMoney $money): bool
    {
        if($money->getCurrencyType() != $this->getCurrencyType()) {
            return false;
        }
        return $this->money->isEqualTo($money->getWrapped());
    }

    public function getCurrency(): EnhancedCurrency
    {
        return $this->currency;
    }

    public function plus(Money|string|int|float $amount, RoundingMode $rounding = RoundingMode::UNNECESSARY): Money
    {
        return $this->forwardBrickOperation('plus', $amount, $rounding);
    }

    public function minus(Money|string|int|float $amount, RoundingMode $rounding = RoundingMode::UNNECESSARY): Money
    {
        return $this->forwardBrickOperation('minus', $amount, $rounding);
    }

    public function multipliedBy(Money|string|int|float $amount, RoundingMode $rounding = RoundingMode::UNNECESSARY): Money
    {
        return $this->forwardBrickOperation('multipliedBy', $amount, $rounding);
    }

    public function dividedBy(Money|string|int|float $amount, RoundingMode $rounding = RoundingMode::UNNECESSARY): Money
    {
        return $this->forwardBrickOperation('dividedBy', $amount, $rounding);
    }

    protected function forwardBrickOperation(string $operation, Money|string|int|float $amount, RoundingMode $rounding): Money
    {
        if($amount instanceof Money) {
            if(!$this->currency->is($amount->getCurrency())) {
                throw new MoneyMismatchException(sprintf(
                    'The monies do not share the same currency: expected %s, got %s.',
                    $this->getCurrency()->getCurrencyCode(),
                    $amount->getCurrency()->getCurrencyCode()
                ));
            }
            $amount =  $amount->getDecimalAmount();
        }
        try {
            return $this->fromBrick($this->money->$operation(
                that:$amount,
                roundingMode:$rounding->value
            ));
        } catch (\Brick\Math\Exception\RoundingNecessaryException $th) {
            throw new RoundingNecessaryException($th->getMessage(), 0, $th );
        } catch (\Brick\Math\Exception\MathException $th) {
            throw new MathException($th->getMessage(), 0, $th );
        }
    }

    public function split(int $parts): array
    {
        return $this->wrapBricks($this->money->split($parts));
    }

    public function allocate(...$proportions): array
    {
        return $this->wrapBricks($this->money->allocate(...$proportions));
    }

    public function getDecimalAmount(): string
    {
        return $this->money->getAmount()->__toString();
    }
}