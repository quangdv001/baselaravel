<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'title', 'slug', 'meta', 'img' , 'description', 'is_combo', 'type', 'status', 'category_id', 'price', 'color', 'material', 'style', 'guarantee', 'size', 'material_id'
        
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function material(){
        return $this->belongsTo('App\Models\Material');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImg');
    }
}
