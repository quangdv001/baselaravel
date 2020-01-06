<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $fillable = [
        'name', 'phone', 'email', 'gender', 'id_number', 'id_place', 'id_time', 'address', 'status', 'user_id'
    ];

}
