<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRiwayatPendidikanFormal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_riwayat_pendidikan_formal', function (Blueprint $table) {
            $table->id();
            $table->integer('id_jenjang_pendidikan');
            $table->integer('id_detail_jenjang_pendidikan');
            $table->string('nama_lembaga_pendidikan')->nullable();
            $table->string('tempat_lembaga_pendidikan')->nullable();
            $table->string('nama_kepala_lembaga_pendidikan')->nullable();
            $table->string('gelar')->nullable();
            $table->string('no_ijazah_sertifikat')->nullable();
            $table->date('tanggal_ijazah_sertifikat');
            $table->integer('id_biaya_belajar');
            $table->string('atas_izin_pimpinan')->nullable();
            $table->string('sk')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->string('dokumen_pendidikan_formal');
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
        Schema::dropIfExists('t_riwayat_pendidikan_formal');
    }
}
