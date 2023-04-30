<?php

namespace App\Models;

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
        'amount'
    ];

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}