<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['toko_id', 'uuid', 'name', 'phone', 'email', 'address', 'photo', 'account_holder', 'account_number', 'bank_name'];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
