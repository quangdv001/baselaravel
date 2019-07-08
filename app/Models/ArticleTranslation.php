<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
    
    protected $table = 'article_translation';
    protected $fillable = [
        'title', 'slug', 'meta',  'short_description', 'description', 'article_id', 'locale'
    ];
    public $timestamps = false;

}
