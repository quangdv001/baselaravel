<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Renter extends Model
{
    protected $table = 'renter';
    protected $fillable = [
        'name', 'phone', 'email', 'gender', 'id_number', 'id_place', 'id_time', 'address', 'user_id', 'status'
    ];
}
