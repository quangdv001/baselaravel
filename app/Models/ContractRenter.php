<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractRenter extends Model
{
    protected $table = 'contract_renter';
    protected $fillable = [
        'name', 'phone', 'email', 'user_id', 'renter_id', 'status'
    ];
}
