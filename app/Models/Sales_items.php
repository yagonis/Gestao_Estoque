<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sales_items extends Model
{
    protected $table = 'sales_items';

    protected $fillable = [
        'id',
        'sale_id',
        'product_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];
    

    public function sale()
    {
        return $this->belongsTo(Sales::class);
    }
}
