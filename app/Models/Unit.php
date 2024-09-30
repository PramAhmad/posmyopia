<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = ['toko_id', 'name', 'slug', 'short_code'];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
