<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableNotifikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_notifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->text('message');
            $table->integer('read_at');
            $table->integer('make_at');
            $table->integer('recipient_at');
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
        Schema::dropIfExists('table_notifikasi');
    }
}
