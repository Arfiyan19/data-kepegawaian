<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRiwayatSkpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_riwayat_skp', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->float('nilai');
            $table->float('opl');
            $table->float('int');
            $table->float('kom');
            $table->float('dis');
            $table->float('ksm');
            $table->float('kpm');
            $table->float('prestasi_kerja')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('table_riwayat_skp');
    }
}
