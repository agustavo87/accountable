<?php

namespace App\Repositories\Currency;

use App\Models\CryptoCurrency;
use App\Values\{Currency, CurrencyType, EnhancedCurrency, WrappedBrickCurrency};
use Brick\Money\Currency as BrickCurrency;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Crypto extends AbstractCurrencyRepository
{
    public const TYPE = CurrencyType::Crypto;

    public static function put($code, $numericCode, $name, $minorUnits)
    {
        CryptoCurrency::create( [
            "code" => $code,
            "numeric_code" => $numericCode,
            "name" => $name,
            "minor_units" => $minorUnits
        ]);
    }

    public function getByNumber(int $code): EnhancedCurrency
    {
        return $this->getCurrencyFromModel(CryptoCurrency::whereNumericCode($code)->first());
    }

    protected function getCurrencyFromModel(CryptoCurrency $currencyModel): EnhancedCurrency
    {
        return new WrappedBrickCurrency(new BrickCurrency(
            currencyCode:$currencyModel->code,
            numericCode:$currencyModel->numeric_code,
            name:$currencyModel->name,
            defaultFractionDigits:$currencyModel->minor_units
        ), self::TYPE);
    }

    public function get(string $code): EnhancedCurrency
    {
        return $this->getCurrencyFromModel(CryptoCurrency::whereCode($code)->first());
    }

    public function search($field, $hint, $count = 5): array 
    {
        return CryptoCurrency::query()
            ->when($hint, function (Builder $query, $value) use ($field) {
                return $query->where($field, 'LIKE', "%$value%");
            })
            ->take($count)
            ->get()
            ->toArray();
    }
}