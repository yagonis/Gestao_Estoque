<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Sales extends Model
{

protected $table = 'sales';
protected $fillable = [
        'user_id',
        'total_price',
        'sale_date',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(salesItems::class, 'sale_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
