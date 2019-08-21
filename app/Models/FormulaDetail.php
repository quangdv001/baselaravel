<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormulaDetail extends Model
{
    protected $table = 'formula_detail';
    protected $fillable = [
        'formula_id', 'name', 'start', 'end', 'type', 'price', 'description'
    ];
}
