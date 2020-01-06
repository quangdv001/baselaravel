<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceFormulaDetail extends Model
{
    protected $table = 'service_formula_detail';
    protected $fillable = [
        'formula_id', 'user_id', 'name', 'description', 'start', 'end', 'type', 'price'
    ];

}
