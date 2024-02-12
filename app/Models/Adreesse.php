<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adreesse extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'cep',
        'street',
        'city',
        'neighborhood',
    ];

    protected $table = 'adreesses';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
