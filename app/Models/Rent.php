<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rent extends Model
{
    protected $table = 'rent';
    protected $fillable = [
        'name', 'floor', 'max', 'user_id', 'motel_id', 'price', 'description', 'status'
    ];
}
