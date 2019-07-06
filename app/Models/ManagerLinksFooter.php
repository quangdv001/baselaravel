<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagerLinksFooter extends Model
{
    protected $table = 'manager_links_footer';
    protected $fillable = [
        'title', 'slug', 'content', 'meta', 'status'
    ];
}
