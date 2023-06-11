<?php

namespace App\Values;

use Brick\Money\Money as BrickMoney;
use App\Repositories\Currency\Factory as CurrencyRepositoryFactory;
use Brick\Math\RoundingMode;
use Brick\Money\Context;

class MoneyFactory
{
    public static function of(string $decimal, $fiatCode, ?Context $context = null, int $rounding = RoundingMode::UNNECESSARY)
    {
        return new Money(
            BrickMoney::of($decimal, $fiatCode, $context, $rounding)
        );
    }

    public static function ofMinor(string $amount, CurrencyType $type, int $currencyNumber)
    {
        $currencyRepository = (new CurrencyRepositoryFactory())->for($type);
        $currency = $currencyRepository->getByNumber($currencyNumber);
        $money = new Money();
        $money->setFromMinor($amount, $currency);
        return $money;
    }
}