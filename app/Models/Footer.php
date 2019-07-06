<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $table = 'config_footer';
    protected $fillable = [
        'code', 'value'
    ];
}
