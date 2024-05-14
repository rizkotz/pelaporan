<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'link','icon'];

    public function Level_menu()
    {
        return $this->hasMany(Level_menu::class, 'id_menu');
    }
}
