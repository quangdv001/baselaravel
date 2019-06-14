<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTag extends Model
{
    protected $table = 'project_tag';
    protected $fillable = [
        'article_id', 'tag_id'
    ];
}
