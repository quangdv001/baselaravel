<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $table = 'advertise';
    protected $fillable = [
        'name', 'img' , 'content', 'url', 'position', 'status', 
        'start_time', 'end_time'
    ];
}
