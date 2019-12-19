<?php

namespace App\Models;

use App\Services\GeneralInfoService;
use Illuminate\Database\Eloquent\Model;

class SettingFooter extends Model
{
    protected $table = 'setting_footer';
    protected $fillable = [
        'type', 'title', 'single_page_id', 'parent_id', 'position', 'general_info_id', 'status', 'img', 'social_id'
    ];

    public function info()
    {
        return $this->belongsTo(GeneralInfo::class, 'general_info_id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'single_page_id');
    }
}
