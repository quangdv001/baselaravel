<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $fillable = [
        'order_id', 'start_name', 'start_id', 'end_name', 'end_id', 'qty', 'start_time', 'end_time'
    ];

}
