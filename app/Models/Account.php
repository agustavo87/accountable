<?php

namespace App\Models;

use App\Support\Facades\Money;
use App\Values\CurrencyType;
use App\Values\Money as MoneyInterface;
use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Account extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['currency'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    public function credit()
    {
        return $this->movements()->where('type', 1);
    }

    public function debit()
    {
        return $this->movements()->where('type', 0);
    }

    public function balance(): Attribute
    {
        return Attribute::make(
            set: fn (MoneyInterface $money) => [
                'balance_amount' => $money->getMinorAmount(),
                'balance_currency_number' => $money->getCurrencyNumber(),
                'balance_currency_type' => $money->getCurrencyType()->value
            ],
            get: fn($value, $attributes) => Money::from(
                    CurrencyType::from($attributes['balance_currency_type'])
                )->ofMinor(
                    $attributes['balance_amount'],
                    $attributes['balance_currency_number']
                )
        )->withoutObjectCaching();
    }

    public function currency(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                try {
                    $type = isset($attributes['balance_currency_type']) ? $attributes['balance_currency_type'] : CurrencyType::Fiat->value;
                    $number = isset($attributes['balance_currency_number']) ? $attributes['balance_currency_number'] : 840;
                    return Money::from(CurrencyType::from($type))->getCurrency($number);
                } catch (\Throwable $th) {
                    throw new Exception("Problem creating Currency Model".json_encode($this->attributes)."\n {$th->getMessage()}", 0, $th);
                }
            }
        );
    }

    public function incrementBalance($amount): static
    {
        $this->balance = $this->balance->plus($amount);
        return $this;
    }

    public function decrementBalance($amount): static
    {
        $this->balance = $this->balance->minus($amount);
        return $this;
    }
}
