<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motel extends Model
{
    protected $table = 'motel';
    protected $fillable = [
        'name', 'address', 'description', 'user_id'
    ];
}
