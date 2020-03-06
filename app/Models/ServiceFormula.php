<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceFormula extends Model
{
    protected $table = 'service_formula';
    protected $fillable = [
        'service_id', 'user_id', 'name', 'start', 'end', 'type', 'price', 'description'
    ];

}
