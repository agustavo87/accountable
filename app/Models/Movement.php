<?php

namespace App\Models;

use App\Support\Facades\Money;
use App\Values\CurrencyType;
use App\Values\Money as MoneyInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'note',
        'minor_amount', 
        'currency_number',
        'currency_type',
    ];

    protected $appends = ['decimal_amount'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'operation_id' => null,
        'account_id' => null,
        'type'      => 0,
        'minor_amount'  => 0,
        'currency_number'   => 32,
        'currency_type' => CurrencyType::Fiat->value,
        'note'  => ''
    ];

    public function decimalAmount(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => isset($attributes['currency_type']) ?
                Money::from(
                    CurrencyType::from($attributes['currency_type'])
                )->ofMinor(
                    $attributes['minor_amount'],
                    $attributes['currency_number']
                )->getDecimalAmount() : 0
        )->withoutObjectCaching();
    }

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function amount(): Attribute
    {
        return Attribute::make(
            set: fn (MoneyInterface $money) => [
                'minor_amount' => $money->getMinorAmount(),
                'currency_number' => $money->getCurrencyNumber(),
                'currency_type' => $money->getCurrencyType()->value
            ],
            get: fn($value, $attributes) => Money::from(
                    CurrencyType::from($attributes['currency_type'])
                )->ofMinor(
                    $attributes['minor_amount'],
                    $attributes['currency_number']
                )
        )->withoutObjectCaching();
    }
}