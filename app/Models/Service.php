<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    protected $table = 'service';
    protected $fillable = [
        'title', 'unit', 'price', 'fixed_price', 'status', 'has_formula', 'description', 'user_id'
    ];
}
