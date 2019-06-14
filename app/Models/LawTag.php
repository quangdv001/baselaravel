<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LawTag extends Model
{
    protected $table = 'law_tag';
    protected $fillable = [
        'article_id', 'tag_id'
    ];
}
