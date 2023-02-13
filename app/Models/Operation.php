<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
