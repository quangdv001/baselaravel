<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regulation extends Model
{
    protected $table = 'regulation';
    protected $fillable = [
        'name', 'file_id', 'status'
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
