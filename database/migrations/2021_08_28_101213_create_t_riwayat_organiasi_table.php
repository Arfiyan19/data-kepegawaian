<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRiwayatOrganiasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_riwayat_organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_organisasi_lembaga')->nullable();
            $table->integer('id_jenis_organisasi');
            $table->integer('id_kedudukan_organiasi');
            $table->string('tempat_kedudukan_organisasi')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->string('surat_keputusan')->nullable();
            $table->date('tanggal_surat_keputusan');
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
        Schema::dropIfExists('t_riwayat_organisasi');
    }
}
