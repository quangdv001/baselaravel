<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandTag extends Model
{
    protected $table = 'land_tag';
    protected $fillable = [
        'land_id', 'tag_id'
    ];
}
