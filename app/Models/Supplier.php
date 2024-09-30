<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $fillable = ['uuid', 'toko_id', 'name', 'phone', 'email', 'address', 'photo', 'shop_name', 'type', 'account_holder', 'account_number', 'bank_name'];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
