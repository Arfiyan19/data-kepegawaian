<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_pegawai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nip');
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('nip_lama')->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('no_kartu_pegawai')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir');
            $table->char('golongan_darah',2)->nullable();
            $table->string('npwp',21)->nullable();
            $table->unsignedBigInteger('nik')->nullable();
            $table->unsignedBigInteger('no_ktp')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_bpjs')->nullable();
            $table->string('document')->nullable();
            $table->string('nama_pegawai')->nullable();
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
        Schema::dropIfExists('t_pegawai');
    }
}
