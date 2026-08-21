<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stock extends Model

{
protected $table = 'stock';

protected $fillable = [
        'type',
        'quantity',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
