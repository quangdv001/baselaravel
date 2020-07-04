<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillService extends Model
{
    protected $table = 'bill_service';
    protected $fillable = [
        'unit', 'qty', 'price', 'total', 'status', 'bill_id', 'service_id', 'user_id'
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }

}
