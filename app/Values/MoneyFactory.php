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

    public function ofMinor(string $amount, int|string $code): Money
    {
        $money = new BrickMoneyWrapperMoney();

        $money->setFromMinor(
            $amount, 
            $this->getCurrency($code)
        );
        return $money;
    }

    public function of(string|int $decimal, string|int $code, RoundingMode $rounding = RoundingMode::UNNECESSARY): Money
    {
        $money = new BrickMoneyWrapperMoney();

        $money->setFromDecimal(
            $decimal, 
            $this->getCurrency($code)
        );
        return $money;
    }
    
    protected function getCurrency(string|int $code): Currency
    {
        if(is_int($code)) {
            return $this->currencies->getByNumber($code);
        } else {
            return $this->currencies->get($code);
        }
    }

    public function brickOf(string $decimal, $fiatCode, ?Context $context = null, int $rounding = BrickRoundingMode::UNNECESSARY): BrickMoneyWrapper
    {
        return new BrickMoneyWrapper(
            BrickMoney::of($decimal, $fiatCode, $context, $rounding)
        );
    }
}