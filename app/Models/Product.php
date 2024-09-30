<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['uuid', 'toko_id', 'category_id', 'unit_id', 'name', 'slug', 'code', 'quantity', 'buying_price', 'selling_price', 'quantity_alert', 'tax', 'notes', 'image'];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

   
}
