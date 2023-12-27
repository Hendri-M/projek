<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DataDiriDosen extends Model
{
    use HasFactory;

    protected $table = 'datas_diri_dosen';
    protected $primaryKey = 'nidn_dosen';

    protected $fillable = [
        'foto_dosen',
        'nidn_dosen',
        'npwp_dosen',
        'nik_dosen',
        'nama_dosen',
        'pendidikan_terakhir',
        'email_dosen',
        'alamat_dosen',
        'bidang_ilmu_dosen',
        'anggota_profesi',
        'rekening_dosen',
        'tanggal_lahir',
        'nomor_wa_telp',
        'pusat_studi',
        'sertifikasi_pendidik',
        'tmt_sk_pertama',
        'ditambahkan_pada',
        'diupdate_pada'
    ];

    public function datas_pendidikan_dosen()
    {
        return $this->hasOne(DataPendidikanDosen::class, 'nidn_dosen');
    }

    public function datas_prodi_dosen()
    {
        return $this->hasOne(DataProdiDosen::class, 'nidn_dosen');
    }

    public function datas_jabatan_dosen()
    {
        return $this->hasOne(DataJabatanAkademik::class, 'nidn_dosen');
    }

    public function datas_pengembangan_diri_dosen()
    {
        return $this->hasOne(DataPengembanganDiri::class, 'nidn_dosen');
    }

    public function datas_staf_dosen()
    {
        return $this->hasOne(DataStaff::class, 'nidn_dosen');
    }

    public $timestamps = false;
}
