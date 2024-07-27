<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;
   /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_unit_kerja',
    ];
}
