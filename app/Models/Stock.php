<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model

{
protected $table = 'stock';

protected $fillable = [
        'user_id',
        'type',
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
