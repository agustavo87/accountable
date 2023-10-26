<?php

namespace App\Repositories\Currency;

use App\Exceptions\CurrencyNotFoundException;
use App\Models\ISOCurrency;
use App\Values\{EnhancedCurrency, WrappedBrickCurrency};
use Brick\Money\Currency as BrickCurrency;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Fiat extends AbstractCurrencyRepository
{
    public function getByNumber(int $code): EnhancedCurrency
    {
        $isoCurrency = ISOCurrency::whereNumber($code)->first();
        if (!$isoCurrency) {
            throw new CurrencyNotFoundException("Currency number '$code' not found");
        }
        return new WrappedBrickCurrency(new BrickCurrency(
            $isoCurrency->code,
            $isoCurrency->number,
            $isoCurrency->name,
            $isoCurrency->minor_units
        ));
    }

    public function get(string $code): EnhancedCurrency
    {
        $isoCurrency = ISOCurrency::whereCode($code)->first();
        if (!$isoCurrency) {
            throw new CurrencyNotFoundException("Currency code '$code' not found");
        }
        return new WrappedBrickCurrency(new BrickCurrency(
            $isoCurrency->code,
            $isoCurrency->number,
            $isoCurrency->name,
            $isoCurrency->minor_units
        ));
    }

    public function search($field, $hint, $count = 5): array 
    {
        return ISOCurrency::query()
            ->when($hint, function (Builder $query, $value) use ($field) {
                return $query->where($field, 'LIKE', "%$value%");
            })
            ->take($count)
            ->get()
            ->toArray();
    }
}