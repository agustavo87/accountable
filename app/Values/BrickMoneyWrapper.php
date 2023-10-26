<?php

namespace App\Values;

use Brick\Money\{
    Money as BrickMoney,
    AbstractMoney,
    RationalMoney
};
use Stringable;

/**
 * A Brick Money Wrapper
 */
class BrickMoneyWrapper implements Stringable
{
    protected BrickMoney|RationalMoney $money;

    /**
     * Currency that wraps a Brick Currency
     * 
     * So also has a type
     *
     * @var WrappedBrickCurrency
     */
    protected WrappedBrickCurrency $currency;

    public function __construct(AbstractMoney|null $money = null, ?WrappedBrickCurrency $currency = null)
    {
        if($money) {
            $this->currency = $currency ?? new WrappedBrickCurrency($money->getCurrency());
            $this->money = $money;
        }
    }

    public function getWrapped(): BrickMoney
    {
        return $this->money;
    }

    public function __call($name, $arguments)
    {
        $arguments = array_map(
            fn($arg) => $arg instanceof BrickMoneyWrapper ? $arg->getWrapped() : $arg,
            $arguments
        );
        // info($name, $arguments);
        return $this->wrapBricks($this->money->$name(...$arguments));
    }

    public function fromBrick(AbstractMoney $brick): static
    {
        return new static($brick, $this->currency); 
    }

    public function wrapBricks($result)
    {
        if ($result instanceof AbstractMoney) {
            return $this->fromBrick($result);
        }
        if (is_array($result)) {
            $result = array_map([$this, 'wrapBricks'], $result);
        }
        return $result;
    }

    public function __toString(): string
    {
        return $this->money->__toString();
    }
}