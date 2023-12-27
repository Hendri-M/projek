<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPendidikanDosen extends Model
{
    use HasFactory;

    protected $table = 'datas_pendidikan_dosen';
    protected $primaryKey = 'nidn_dosen';

    protected $fillable = [
        'nidn_dosen',
        'nama_pt_s1',
        'fakultas_prodi_s1',
        'file_bukti_s1',
        'nama_pt_s2',
        'fakultas_prodi_s2',
        'file_bukti_s2',
        'nama_pt_s3',
        'fakultas_prodi_s3',
        'file_bukti_s3',
        'ditambahkan_pada',
        'diupdate_pada'
    ];

    public function datas_diri_dosen()
    {
        return $this->belongsTo(DataDiriDosen::class, 'nidn_dosen');
    }

    public $timestamps = false;
}
