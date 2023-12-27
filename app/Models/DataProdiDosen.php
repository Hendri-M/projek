<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProdiDosen extends Model
{
    use HasFactory;

    protected $table = 'datas_prodi_dosen';
    protected $primaryKey = 'nidn_dosen';

    protected $fillable = [
        'nidn_dosen',
        'program_studi',
        'nama_kaprodi',
        'tahun_kaprodi',
        'nama_sekretaris_prodi',
        'tahun_sekretaris_prodi',
        'ditambahkan_pada',
        'diupdate_pada'
    ];

    public function datas_diri_dosen()
    {
        return $this->belongsTo(DataDiriDosen::class, 'nidn_dosen');
    }

    public $timestamps = false;
}
