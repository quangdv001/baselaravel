<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formula extends Model
{
    protected $table = 'formula';
    protected $fillable = [
        'service_id', 'user_id', 'name', 'description'
    ];
}
