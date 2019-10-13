<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCombo extends Model
{
    protected $table = 'product_combo';
    protected $fillable = [
        'combo_id', 'product_id'
        
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

}
