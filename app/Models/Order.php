<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'adreesses_id',
        'total_price',
        'payment',
        'status',
    ];

    /*     public function customer()
        {
            return $this->belongsTo(Customer::class, 'customer_id');
        } */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function adreesses()
    {
        return $this->belongsTo(Adreesse::class, 'adreesses_id');
    }

    public function items()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
