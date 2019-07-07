<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'status', 'total'
        
    ];

    public function orderInfo()
    {
        return $this->hasOne('App\Models\OrderInfo');
    }

    public function orderDetail()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

}
