<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datas_diri_dosen', function (Blueprint $table) {
            $table->string('foto_dosen');
            $table->string('nidn_dosen', 16)->primary();
            $table->string('npwp_dosen', 16);
            $table->string('nik_dosen', 16);
            $table->string('nama_dosen', 65);
            $table->string('pendidikan_terakhir');
            $table->string('email_dosen', 20);
            $table->string('alamat_dosen', 50);
            $table->string('bidang_ilmu_dosen');
            $table->string('anggota_profesi', 20);
            $table->string('rekening_dosen', 16);
            $table->date('tanggal_lahir');
            $table->string('nomor_wa_telp', 15);
            $table->string('pusat_studi', 20);
            $table->string('sertifikasi_pendidik', 150);
            $table->string('tmt_sk_pertama', 150);
            $table->timestamp('ditambahkan_pada')->useCurrent();
            $table->timestamp('diupdate_pada')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datas_diri_dosen');
    }
};
