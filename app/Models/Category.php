<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = [
        'name', 'url', 'img', 'description', 'parent_id', 'position', 'type', 'category_id', 'class_name', 'slug'
    ];
    // protected $dates = ['deleted_at'];
}
