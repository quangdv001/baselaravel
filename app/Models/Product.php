<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'title', 'slug', 'meta', 'img' , 'description', 'type', 'status', 'category_id', 'price', 'color', 'material'
        
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
