<?php

namespace App\Models;

use App\Services\MotelRoomService;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contract';
    protected $fillable = [
        'name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'user_id', 'motel_room_id','customer_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function service()
    {
        return $this->hasMany(ContractService::class);
    }

    public function room()
    {
        return $this->belongsTo(MotelRoom::class, 'motel_room_id','id');
    }


}
