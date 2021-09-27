<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRiwayatGajiBerkalaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t__riwayat_gaji_berkala', function (Blueprint $table) {
            $table->id();
            $table->date('terhitung_tanggal_mulai_kepanggkatan');
            $table->string('masa_kerja_gol_tahun_kepanggkatan')->nullable();
            $table->string('masa_kerja_gol_bulan_kepanggkatan')->nullable();
            $table->unsignedBigInteger('gaji_pokok_baru')->nullable();
            $table->unsignedBigInteger('gaji_pokok_lama')->nullable();  
            $table->date('terhitung_tanggal_mulai_penggajian');
            $table->string('no_sk')-> nullable();
            $table->date('tanggal_sk');
            $table->string('masa_kerja_gol_tahun_penggajian')->nullable();
            $table->string('masa_kerja_gol_bulan_penggajian')->nullable();
            $table->string('keterangan_jabatan')->nullable();
            $table->string('pejabat_dan_jabatan_penandatangan_kgb')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('status')->default(0);
            $table->integer('user_id');
            $table->integer('validated_at')->nullable();
            $table->integer('read_at')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t__riwayat_gaji_berkala');
    }
}
