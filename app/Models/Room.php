<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'room';
    protected $fillable = [
        'title', 'img' , 'short_description', 'description', 'type_name', 'status', 'category_id' , 'price', 'acreage', 'direction', 'province_id', 
        'district_id', 'ward_id', 'address',
        'file_path', 'user_id_c', 'user_name_c', 'user_id_u', 'user_name_u', 'admin_id_c', 'admin_name_c', 'admin_id_u', 'admin_name_u'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function images()
    {
        return $this->hasMany('App\Models\RoomImg');
    }
}
