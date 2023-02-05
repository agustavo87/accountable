<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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