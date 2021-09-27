<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKepangkatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_kepangkatan', function (Blueprint $table) {
            $table->id();
            $table->integer('jenis_sk');
            $table->string('gelar_belakang');
            $table->string('gelar_depan');
            $table->string('pangkat');
            $table->string('tgl_sttpl');
            $table->string('no_sk');
            $table->date('tgl_sk');
            $table->date('tmt');
            $table->string('no_persetujuan');
            $table->date('tgl_persetujuan');
            $table->string('masa_kerja_golongan_tahun');
            $table->string('masa_kerja_golongan_bulan');
            $table->string('gaji_pokok');
            $table->string('nomor_sttpl');
            $table->string('nomor_kesehatan');
            $table->date('tgl_kesehatan');
            $table->string('dokumen');
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
        Schema::dropIfExists('table_kepangkatan');
    }
}
