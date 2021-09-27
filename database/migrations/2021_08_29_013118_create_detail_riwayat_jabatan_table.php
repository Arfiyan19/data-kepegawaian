<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRiwayatJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_riwayat_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('no_sk')->unique();
            $table->bigInteger('id_master_diterbitkan');
            $table->bigInteger('id_master_pangkat');
            $table->bigInteger('id_master_induk_unit_kerja');
            $table->bigInteger('id_master_unit_organisasi');
            $table->bigInteger('id_master_jenis_jabatan');
            $table->longText('keterangan_jabatan');
            $table->bigInteger('id_master_group_fungsional');
            $table->bigInteger('id_master_jabatan_fungsional_tertentu');
            $table->bigInteger('id_master_jabatan_fungsional_umum');
            $table->bigInteger('id_master_status_jabatan');
            $table->bigInteger('id_master_alasan_jabatan_sementara');
            $table->longText('catatan');
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
        Schema::dropIfExists('detail_riwayat_jabatan');
    }
}
