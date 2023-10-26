<?php

namespace App\Repositories\Currency;

use App\Exceptions\CurrencyNotFoundException;
use App\Models\{CustomCurrency, User};
use App\Values\{Currency, CurrencyType, EnhancedCurrency, WrappedBrickCurrency};
use Brick\Money\Currency as BrickCurrency;
use Illuminate\Support\Collection;

class Custom extends AbstractCurrencyRepository
{
    public const TYPE = CurrencyType::Custom;

    protected ?User $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    public function put(string $code, string $name, int $minorUnits)
    {
        CustomCurrency::create([
            'user_id'       => $this->user->id, 
            'code'          => $code, 
            'name'          => $name,
            'minor_units'   => $minorUnits
        ]);
    }

    public function getByNumber(int $number): EnhancedCurrency
    {
        return $this->getCurrencyFromModel(CustomCurrency::find($number)->first());
    }

    protected function getCurrencyFromModel(CustomCurrency $currencyModel): WrappedBrickCurrency
    {
        return new WrappedBrickCurrency(new BrickCurrency(
            currencyCode:$currencyModel->code,
            numericCode:$currencyModel->id,
            name:$currencyModel->name,
            defaultFractionDigits:$currencyModel->minor_units
        ), self::TYPE);
    }

    public function get(string $code): EnhancedCurrency
    {
        $currency = CustomCurrency::where([
            ['user_id', $this->user->id],
            ['code', $code]
        ])->first();
        if (!$currency) {
            throw new CurrencyNotFoundException("Can't find custom currency for the code '$code' for the current user.");
        }
        return $this->getCurrencyFromModel($currency);
    }

    public function all(): Collection
    {
        return CustomCurrency::whereUserId($this->user->id)->get()
            ->map(function (CustomCurrency $currency) {
                return $this->getCurrencyFromModel($currency);
            });
    }
}