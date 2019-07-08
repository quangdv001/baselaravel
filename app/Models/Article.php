<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Article extends Model implements TranslatableContract
{
    use Translatable;
    protected $table = 'article';
    public $translatedAttributes = ['title', 'slug', 'meta', 'short_description', 'description'];
    protected $fillable = [
        'img', 'status', 'category_id', 
        'admin_id_c', 'admin_name_c', 'admin_id_u', 'admin_name_u'
    ];

    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag', 'article_tag');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ArticleImg');
    }
}
