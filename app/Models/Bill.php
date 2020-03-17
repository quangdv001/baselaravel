<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bill';
    protected $fillable = [
        'name', 'note', 'other_price', 'service_price', 'debit_price', 'discount_price', 'total_price', 'status', 'user_id', 'contract_id'
    ];

}
