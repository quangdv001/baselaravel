<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractCustomer extends Model
{
    protected $table = 'contract_customer';
    protected $fillable = [
        'contract_id', 'customer_id'
    ];

}
