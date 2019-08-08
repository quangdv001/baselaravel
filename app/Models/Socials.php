<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socials extends Model
{
    protected $table = 'social_links';
    protected $fillable = [
        'title', 'slug', 'value', 'en_value'
    ];
}
