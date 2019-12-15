<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingFooter extends Model
{
    protected $table = 'setting_footer';
    protected $fillable = [
        'type', 'title', 'single_page_id', 'parent_id', 'position', 'general_info_id', 'status', 'img'
    ];
}
