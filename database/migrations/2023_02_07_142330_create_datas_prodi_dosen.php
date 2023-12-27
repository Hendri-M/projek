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
        Schema::create('datas_prodi_dosen', function (Blueprint $table) {
            $table->string('nidn_dosen', 16)->primary();
            $table->string('program_studi', 50);
            $table->string('nama_kaprodi', 100);
            $table->string('tahun_kaprodi', 10);
            $table->string('nama_sekretaris_prodi', 100);
            $table->string('tahun_sekretaris_prodi', 10);
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
        Schema::dropIfExists('datas_prodi_dosen');
    }
};
