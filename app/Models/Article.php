<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $fillable = [
        'title', 'slug', 'meta', 'img' , 'short_description', 'description', 'type', 'status', 'category_id'
    ];
}
