<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxTag extends Model
{
    protected $table = 'tax_tag';
    protected $fillable = [
        'article_id', 'tag_id'
    ];
}
