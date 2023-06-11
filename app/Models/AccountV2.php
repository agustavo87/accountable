<?php

namespace App\Models;

use App\Support\Facades\Money as MoneyFacade;
use App\Values\CurrencyType;
use App\Values\Money;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AccountV2 extends Model
{
    use HasFactory;

    protected $table = 'accounts_v2';

    protected $guarded = [];

    public function balance(): Attribute
    {
        return Attribute::make(
            set: fn (Money $money) => [
                'balance_amount' => $money->getMinorAmount(),
                'balance_currency_number' => $money->getCurrencyNumber(),
                'balance_currency_type' => $money->getCurrencyType()->value
            ],
            get: fn($value, $attributes) => MoneyFacade::ofMinor(
                $attributes['balance_amount'],
                CurrencyType::from($attributes['balance_currency_type']),
                $attributes['balance_currency_number']
            )
        );
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function movements()
    // {
    //     return $this->hasMany(Movement::class);
    // }
}
