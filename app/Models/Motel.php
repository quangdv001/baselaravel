<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motel extends Model
{
    protected $table = 'motel';
    protected $fillable = [
        'name', 'address', 'description', 'status', 'user_id'
    ];

}
