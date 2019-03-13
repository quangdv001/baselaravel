<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupPermission extends Model
{
//    use SoftDeletes;
    protected $table = 'group_permission';
    protected $fillable = [
        'name'
    ];
    protected $dates = ['deleted_at'];

    public function permission()
    {
        return $this->hasMany(Permission::class, 'group_id');
    }
}
