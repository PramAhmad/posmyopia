<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'route',
        'icon',
        'parent_id',
        'created_at',
        'updated_at',
    ];

    public function roleMenus()
    {
        return $this->hasMany(RoleMenu::class);
    }
}
