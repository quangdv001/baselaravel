<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    protected $table = 'contract';
    protected $fillable = [
        'name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'user_id', 'rent_id'
    ];

    public function renter()
    {
        return $this->hasOne('App\Models\Renter');
    }
    
    public function service()
    {
        return $this->belongsToMany('App\Models\Service');
    }
}
