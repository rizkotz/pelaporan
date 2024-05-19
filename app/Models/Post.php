<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
     /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'waktu',
        'anggota',
        'tempat',
        'jenis',
        'judul',
        'deskripsi',
        'bidang',
        'tanggungjawab',
        'dokumen',
        'templateA',
        'templateB',
        'rubrik',
        'hasilReviu',
        'hasilBerita',
        'hasilPengesahan',
        'hasilRubrik',
        'approvalReviu',
        'approvalBerita',
        'approvalPengesahan',
        'approvalRubrik',
    ];
}
