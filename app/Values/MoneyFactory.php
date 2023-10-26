<?php

namespace App\Values;

use App\Exceptions\CurrencyNotFoundException;
use App\Exceptions\MoneyException;
use App\Repositories\Currency\CurrencyRepository;
use App\Repositories\Currency\Custom as CustomCurrencyRepository;
use App\Repositories\Currency\Factory as CurrencyRepositoryFactory;
use Brick\Money\Context;
use Brick\Money\Money as BrickMoney;
use Brick\Math\RoundingMode as BrickRoundingMode;

class MoneyFactory
{
    /**
     * The type of the money factory
     */
    protected CurrencyType $type;

    /**
     * A currency repository of the money factory type
     */
    protected CurrencyRepository $currencies;

    public function __construct(CurrencyType $type = CurrencyType::Fiat, array $params = [])
    {
        $this->type = $type;
        $this->currencies = static::currencies($type, $params);
    }

    public static function currencies(CurrencyType $type, $params = []): CurrencyRepository
    {
        return (new CurrencyRepositoryFactory())->for($type, $params);
    }

    public static function customCurrenciesOf($user): CustomCurrencyRepository
    {
        return static::currencies(CurrencyType::Custom, [$user]);
    }

    public static function from(CurrencyType $type, array $params = []): static
    {
        return new static($type, $params);
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
        try {
            $money->setFromDecimal(
                $decimal, 
                $this->getCurrency($code),
                $rounding
            );
        } catch (CurrencyNotFoundException $th) {
            throw new CurrencyNotFoundException("Problem creating money from '$decimal' and currency '$code', with Rounding: $rounding->value.\n {$th->getMessage()}");
        } catch (\Throwable $th) {
            throw new MoneyException("Problem creating money from '$decimal' and currency '$code', with Rounding: $rounding->value.\n {$th->getMessage()}");
        }

        return $money;
    }
    
    public function getCurrency(string|int $code): Currency
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