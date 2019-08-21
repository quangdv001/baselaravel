<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    protected $table = 'bill';
    protected $fillable = [
        'motel_name', 'rent_name', 'name', 'note', 'other_price', 'service_price', 'debit_price', 'discount_price', 'total_price', 'status', 'user_id', 'rent_id', 'motel_id'
    ];
}
