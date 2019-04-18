<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $fillable = [
        'title', 'slug', 'meta', 'img' , 'short_description', 'description', 'type', 'status', 'category_id', 
        'file_path', 'user_id_c', 'user_name_c', 'user_id_u', 'user_name_u', 'admin_id_c', 'admin_name_c', 'admin_id_u', 'admin_name_u'
    ];

    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag', 'article_tag');
    }
}
