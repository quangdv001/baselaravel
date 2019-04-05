<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    protected $table = 'district';
    protected $fillable = [
        'name', 'code', 'province_id', 'province_code'
    ];
}
