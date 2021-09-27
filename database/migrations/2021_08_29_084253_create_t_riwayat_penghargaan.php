<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRiwayatPenghargaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_riwayat_penghargaan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tanda_jasa_penghargaan')->nullable();
            $table->string('no_sk')->nullable();
            $table->date('tanggal_sk');
            $table->string('no_piagam');
            $table->date('tanggal_piagam');
            $table->string('badan_instansi_yg_memberikan');
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
        Schema::dropIfExists('t_riwayat_penghargaan');
    }
}
