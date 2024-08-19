<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peta extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'waktu',
        'anggota',
        'jenis',
        'judul',
        'dokumen',
        'approvalPr',
        'koreksiPr',
        'kode_regist',
        'iku',
        'sasaran',
        'proker',
        'indikator',
        'anggaran',
        'pernyataan',
        'kategori',
        'uraian',
        'metode',
        'skor_kemungkinan',
        'skor_dampak',
        'tingkat_risiko',
    ];

    public function getApprovalStatusAttribute()
    {
        $approvedCount = 0;

        if ($this->approvalPr == 'approved') $approvedCount++;

        return $approvedCount;
    }

    public function getStatusAttribute()
    {
        $approvedCount = $this->approval_status;

        if ($approvedCount == 0) {
            return 'Belum';
        } else {
            return 'Selesai';
        }
    }
    public function comment_prs()
    {
        return $this->hasMany(CommentPr::class);
    }
    public function documentHistories()
    {
        return $this->hasMany(DocumentHistory::class);
    }
}
