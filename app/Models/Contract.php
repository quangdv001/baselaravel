<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contract';
    protected $fillable = [
        'name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'user_id', 'motel_room_id'
    ];

    public function service()
    {
        return $this->hasMany(ContractService::class);
    }

    public function room()
    {
        return $this->belongsTo(MotelRoom::class);
    }

}
