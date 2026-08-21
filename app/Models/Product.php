<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category_id',
        'stock_id',
    ];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

}
