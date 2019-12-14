<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingFooter extends Model
{
    protected $table = 'setting_footer';
    protected $fillable = [
        'type', 'content', 'single_page_id', 'parent_id', 'position', 'social', 'status', 'img'
    ];
}
