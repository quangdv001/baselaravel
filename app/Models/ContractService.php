<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractService extends Model
{
    protected $table = 'rent';
    protected $fillable = [
        'contract_id', 'service_id'
    ];
}
