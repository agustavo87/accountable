<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Operation
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string|null $notes
 * @property int $category_id
 * @property int $user_id
 * @property-read \App\Models\OperationCategory $category
 * @property-read mixed $date
 * @property-read mixed $date_string
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Movement> $movements
 * @property-read int|null $movements_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\OperationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Operation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Operation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Operation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Operation whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operation whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operation whereUserId($value)
 * @mixin \Eloquent
 */
class Operation extends Model
{
    use HasFactory;

    protected $appends = [
        'date',
        'date_string'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(OperationCategory::class, 'category_id');
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    public function getDateAttribute()
    {
        return $this->created_at?->toFormattedDateString();
    }

    public function getDateStringAttribute()
    {
        return $this->created_at?->toDateString();
    }
}
