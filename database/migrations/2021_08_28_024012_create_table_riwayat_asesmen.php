<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRiwayatAsesmen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_riwayat_asesmen', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_asesmen');
            $table->integer('nilai_kompetensi');
            $table->integer('nilai_potensi');
            $table->integer('id_jabatan');
            $table->integer('id_unit_kerja');
            $table->string('dokumen_asesmen');
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
        Schema::dropIfExists('table_riwayat_asesmen');
    }
}
