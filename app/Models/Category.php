<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    use HasFactory;
    protected $fillable = ['toko_id', 'name', 'slug'];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
