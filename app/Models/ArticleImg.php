<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleImg extends Model
{
    protected $table = 'article_img';
    protected $fillable = [
        'article_id', 'img'
    ];
}
