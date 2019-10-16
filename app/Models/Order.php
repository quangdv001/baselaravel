<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'status', 'payment_method'
        
    ];

    public function orderInfo()
    {
        return $this->hasOne('App\Models\OrderInfo');
    }

    public function orderDetail()
    {
        return $this->hasOne('App\Models\OrderDetail');
    }

}
