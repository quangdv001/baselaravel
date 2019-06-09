<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = 'folder';
    protected $fillable = [
        'name', 'parent_id' , 'user_id_c', 'user_name_c', 'user_id_u', 'user_name_u', 'admin_id_c', 'admin_name_c', 'admin_id_u', 'admin_name_u'
    ];
}
