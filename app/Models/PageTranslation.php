<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    
    protected $table = 'page_translation';
    protected $fillable = [
        'title', 'slug', 'meta', 'description', 'page_id', 'locale'
    ];
    public $timestamps = false;

}
