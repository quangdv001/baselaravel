<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    protected $table = 'order_info';
    protected $fillable = [
        'order_id', 'email', 'name', 'phone', 'address', 'note'
    ];

}
