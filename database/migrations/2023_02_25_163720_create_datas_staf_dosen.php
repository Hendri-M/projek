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
        Schema::create('datas_staf_dosen', function (Blueprint $table) {
            $table->string('nidn_dosen', 16)->primary();
            $table->string('staff', 20);
            $table->string('fakultas_prodi', 25);
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
        Schema::dropIfExists('datas_staf_dosen');
    }
};
