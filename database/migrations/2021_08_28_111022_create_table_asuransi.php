<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAsuransi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_asuransi', function (Blueprint $table) {
            $table->id();
            $table->string('no_polis');
            $table->string('nama_perusahaan');
            $table->string('id_jenis_asuransi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
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
        Schema::dropIfExists('table_asuransi');
    }
}
