<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OperationCategory
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Operation> $operations
 * @property-read int|null $operations_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\OperationCategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationCategory whereUserId($value)
 * @mixin \Eloquent
 */
class OperationCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function operations()
    {
        return $this->hasMany(Operation::class, 'category_id');
    }
}
