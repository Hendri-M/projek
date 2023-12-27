<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengembanganDiri extends Model
{
    use HasFactory;
    protected $table = 'datas_pengembangan_diri_dosen';
    protected $primaryKey = 'nidn_dosen';

    protected $fillable = [
        'nidn_dosen',
        'workshop_seminar',
        'keterangan',
        'bukti_kegiatan',
        'ditambahkan_pada',
        'diupdate_pada'
    ];

    public function datas_diri_dosen()
    {
        return $this->belongsTo(DataDiriDosen::class, 'nidn_dosen');
    }

    public $timestamps = false;
}
