<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $fillable = [
        'title', 'slug', 'meta', 'img' , 'short_description', 'description', 'type', 'status', 'category_id', 'file_path'
    ];

    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag', 'article_tag');
    }
}
