<?php

namespace App\Values;

use App\Repositories\Currency\CurrencyRepository;
use App\Repositories\Currency\Factory as CurrencyRepositoryFactory;
use Brick\Money\Context;
use Brick\Money\Money as BrickMoney;
use Brick\Math\RoundingMode as BrickRoundingMode;

class MoneyFactory
{
    protected CurrencyType $type;
    protected CurrencyRepository $currencies;

    public function __construct(CurrencyType $type = CurrencyType::Fiat)
    {
        $this->type = $type;
        $this->currencies = (new CurrencyRepositoryFactory())->for($this->type);
    }

    public static function from(CurrencyType $type): static
    {
        return new static($type);
    }

    public function ofMinor(string $amount, int|string $currencyNumber): Money
    {
        $money = new BrickMoneyWrapperMoney();
        $money->setFromMinor(
            $amount, 
            $this->currencies->getByNumber($currencyNumber)
        );
        return $money;
    }

    public function of(string|int $decimal, $fiatCode, RoundingMode $rounding = RoundingMode::UNNECESSARY): Money
    {
        return new BrickMoneyWrapperMoney(
            BrickMoney::of(
                amount:$decimal,
                currency:$fiatCode,
                roundingMode:$rounding->value
            )
        );
    }

    public function brickOf(string $decimal, $fiatCode, ?Context $context = null, int $rounding = BrickRoundingMode::UNNECESSARY): BrickMoneyWrapper
    {
        return new BrickMoneyWrapper(
            BrickMoney::of($decimal, $fiatCode, $context, $rounding)
        );
    }
}