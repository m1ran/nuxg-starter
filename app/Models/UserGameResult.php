<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGameResult extends Model
{
    protected $fillable = [
        'user_id',
        'number',
        'win',
        'win_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
