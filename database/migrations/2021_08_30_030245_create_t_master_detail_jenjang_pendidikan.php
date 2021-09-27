<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTMasterDetailJenjangPendidikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_master_detail_jenjang_pendidikan', function (Blueprint $table) {
            $table->id('id_detail_jenjang_pendidikan');
            $table->string('nama_detail_jenjang_pendidikan')->nullable();
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
        Schema::dropIfExists('t_master_detail_jenjang_pendidikan');
    }
}
