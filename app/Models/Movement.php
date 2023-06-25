<?php

namespace App\Models;

use App\Support\Facades\Money;
use App\Values\CurrencyType;
use App\Values\Money as MoneyI;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Movement
 *
 * @property int $id
 * @property int $operation_id
 * @property int $account_id
 * @property int $type
 * @property float $amount
 * @property \App\Values\BrickMoneyWrapperMoney $amountc
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Account $account
 * @property-read \App\Models\Operation $operation
 * @method static \Database\Factories\MovementFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Movement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereOperationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'note',
        'amount',
        'amountb', 
        'currency_number',
        'currency_type',
    ];

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function amountc(): Attribute
    {
        return Attribute::make(
            set: fn (MoneyI $money) => [
                'amountb' => $money->getMinorAmount(),
                'currency_number' => $money->getCurrencyNumber(),
                'currency_type' => $money->getCurrencyType()->value
            ],
            get: fn($value, $attributes) => Money::from(
                    CurrencyType::from($attributes['currency_type'])
                )->ofMinor(
                    $attributes['amountb'],
                    $attributes['currency_number']
                )
        )->withoutObjectCaching();
    }
}