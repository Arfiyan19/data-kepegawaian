<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_detail_pegawai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jenis_kelamin')->nullable();
            $table->unsignedBigInteger('id_agama')->nullable();
            $table->unsignedBigInteger('id_disabilitas')->nullable();
            $table->unsignedBigInteger('id_pegawai');
            $table->unsignedBigInteger('id_phone_number')->nullable();
            $table->unsignedBigInteger('id_email')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('detail_pegawai');
    }
}
