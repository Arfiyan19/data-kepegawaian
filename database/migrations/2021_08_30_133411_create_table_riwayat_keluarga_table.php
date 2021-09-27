<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRiwayatKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_riwayat_keluarga', function (Blueprint $table) {
            $table->id();
            $table->integer('id_hub_kepala_keluarga');
            $table->string('nama_lengkap')->nullable();
            $table->date('tgl_lahir');
            $table->string('kota_lahir')->nullable();
            $table->integer('id_jenjang_pendidikan');
            $table->string('jenis_kelamin');
            $table->string('dokumen_riwayat_keluarga');
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
        Schema::dropIfExists('table_riwayat_keluarga');
    }
}
