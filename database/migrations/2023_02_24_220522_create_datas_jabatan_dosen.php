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
        Schema::create('datas_jabatan_dosen', function (Blueprint $table) {
            $table->string('nidn_dosen', 16)->primary()->foreign('nidn_dosen')->references('nidn_nik')->on('users');
            $table->string('jabatan_akademik', 30);
            $table->string('pangkat', 50);
            $table->string('golongan', 6);
            $table->string('angka_kredit', 4);
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
        Schema::dropIfExists('datas_jabatan_dosen');
    }
};
