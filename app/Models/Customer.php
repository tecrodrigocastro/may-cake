<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'cpf',
        'email',
        'password',
    ];

    //adreesses

    protected $hidden = [
        'password',
    ];

    public function adreesses()
    {
        return $this->hasMany(Adreesse::class);
    }
}
