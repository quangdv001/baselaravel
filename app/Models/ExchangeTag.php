<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeTag extends Model
{
    protected $table = 'exchange_tag';
    protected $fillable = [
        'exchange_id', 'tag_id'
    ];
}
