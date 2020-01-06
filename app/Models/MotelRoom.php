<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotelRoom extends Model
{
    protected $table = 'motel_room';
    protected $fillable = [
        'name', 'floor', 'max', 'price', 'description', 'status', 'motel_id', 'user_id'
    ];

}
