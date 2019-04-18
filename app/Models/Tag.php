<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
    protected $fillable = [
        'name'
    ];

    public function article()
    {
        return $this->belongsToMany('App\Models\Article', 'article_tag');
    }

}
