<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRiwayatJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_riwayat_jabatan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_unit_organisasi');
            $table->bigInteger('id_kantor');
            $table->string('no_sk')->unique();
            $table->date('tgl_sk');
            $table->date('tgl_tmt');
            $table->integer('status')->default(0);
            $table->string('dokumen')->nullable();
            $table->integer('user_id');
            $table->integer('validated_at')->default(0);
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
        Schema::dropIfExists('table_riwayat_jabatan');
    }
}
