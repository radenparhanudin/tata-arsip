<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblArsipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_arsip', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sk_id');
            $table->foreign('sk_id')->references('id')->on('tbl_sk')->onDelete('cascade');
            $table->unsignedBigInteger('pegawai_id');
            $table->foreign('pegawai_id')->references('id')->on('tbl_pegawai')->onDelete('cascade');
            $table->string('file_arsip');
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
        Schema::dropIfExists('tbl_arsip');
    }
}
