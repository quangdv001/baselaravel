<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'image', 'content_vi', 'content_en', 
        'admin_id_c', 'admin_name_c', 'admin_id_u', 'admin_name_u'
    ];
}
