<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = [
        'amount', 'duration', 'user_id', 'created_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
