<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomImg extends Model
{
    protected $table = 'room_img';
    protected $fillable = [
        'room_id', 'img'
    ];
}
