<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{

protected $table = 'sales';
protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'total_price',
        'sale_date',
        'status',
    ];

    public function sales_item(){
        return $this->hasMany(Sales_item::class);
    }
}
