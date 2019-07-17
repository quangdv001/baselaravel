<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomTag extends Model
{
    protected $table = 'room_tag';
    protected $fillable = [
        'room_id', 'tag_id'
    ];
}
