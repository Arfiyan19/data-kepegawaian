<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCuti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_cuti', function (Blueprint $table) {
            $table->id();
            $table->integer('jenis_cuti');
            $table->string('no_surat_ijin');
            $table->date('tanggal_surat_ijin');
            $table->date('tanggal_surat_mulai');
            $table->date('tanggal_surat_selesai');
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
        Schema::dropIfExists('table_cuti');
    }
}
