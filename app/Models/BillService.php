<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillService extends Model
{
    protected $table = 'bill';
    protected $fillable = [
        'unit', 'qty', 'price', 'total', 'status', 'bill_id', 'service_id', 'motel_id'
    ];
}
