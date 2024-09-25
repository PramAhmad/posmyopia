<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;
    protected $fillable = ['logo', 'nama_toko', 'domisili', 'alamat_usaha', 'nohp'];
}
