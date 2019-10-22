<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractRenter extends Model
{
    protected $table = 'contract_renter';
    protected $fillable = [
        'contract_id', 'renter_id'
    ];
}
