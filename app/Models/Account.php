<?php

namespace App\Models;

use App\Support\Facades\Money;
use App\Values\CurrencyType;
use App\Values\Money as MoneyI;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Account
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Values\BrickMoneyWrapperMoney $balanceb
 * @property int $user_id
 * @property string $name
 * @property string $currency
 * @property float $balance
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Movement> $movements
 * @property-read int|null $movements_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\AccountFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUserId($value)
 * @mixin \Eloquent
 */
class Account extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    public function balanceb(): Attribute
    {
        return Attribute::make(
            set: fn (MoneyI $money) => [
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

    public function incrementBalance($amount): static
    {
        $this->balanceb = $this->balanceb->plus($amount);
        $this->balance += $amount;
        return $this;
    }

    public function decrementBalance($amount): static
    {
        $this->balanceb = $this->balanceb->minus($amount);
        $this->balance -= $amount;
        return $this;
    }
}
