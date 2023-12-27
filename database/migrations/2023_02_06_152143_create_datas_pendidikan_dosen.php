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
        Schema::create('datas_pendidikan_dosen', function (Blueprint $table) {
            $table->string('nidn_dosen', 16)->primary();
            $table->string('nama_pt_s1');
            $table->string('fakultas_prodi_s1');
            $table->string('file_bukti_s1');
            $table->string('nama_pt_s2')->nullable();
            $table->string('fakultas_prodi_s2')->nullable();
            $table->string('file_bukti_s2')->nullable();
            $table->string('nama_pt_s3')->nullable();
            $table->string('fakultas_prodi_s3')->nullable();
            $table->string('file_bukti_s3')->nullable();
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
        Schema::dropIfExists('datas_pendidikan_dosen');
    }
};
