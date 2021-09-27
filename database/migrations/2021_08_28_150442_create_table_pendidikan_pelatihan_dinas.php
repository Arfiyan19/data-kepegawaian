<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePendidikanPelatihanDinas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_pendidikan_pelatihan_dinas', function (Blueprint $table) {
            $table->id();
            $table->string('lembaga_penyelenggara');
            $table->string('lokasi');
            $table->string('tanggal_mulai');
            $table->string('tanggal_berakhir');
            $table->string('no_sk_kelulusan');
            $table->string('jam_latihan');
            $table->string('tangal_sk_kelulusan');
            $table->string('no_sertifikat');
            $table->string('tanggal_no_sertifikat');
            $table->string('jenis_diklat');
            $table->integer('user_id');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('table_pendidikan_pelatihan_dinas');
    }
}
