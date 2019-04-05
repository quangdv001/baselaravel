<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ward extends Model
{
    protected $table = 'ward';
    protected $fillable = [
        'name', 'code', 'province_id', 'province_code', 'district_id', 'district_code'
    ];
}
