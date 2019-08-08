<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Page extends Model implements TranslatableContract
{
    use Translatable;
    protected $table = 'page';
    public $translatedAttributes = ['title', 'slug', 'meta', 'content'];
    protected $fillable = [
        'admin_id_c', 'admin_name_c', 'admin_id_u', 'admin_name_u'
    ];
}
