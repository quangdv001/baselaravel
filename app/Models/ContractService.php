<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractService extends Model
{
    protected $table = 'contract_service';
    protected $fillable = [
        'contract_id', 'service_id'
    ];

}
