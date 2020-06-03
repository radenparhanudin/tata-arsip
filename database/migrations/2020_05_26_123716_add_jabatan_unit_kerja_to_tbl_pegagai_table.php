<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJabatanUnitKerjaToTblPegagaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_pegawai', function (Blueprint $table) {
            $table->unsignedBigInteger('jabatan_id')->nullable();
            $table->foreign('jabatan_id')->references('id')->on('tbl_jabatan')->onDelete('cascade');
            $table->unsignedBigInteger('unit_kerja-id')->nullable();
            $table->foreign('unit_kerja-id')->references('id')->on('tbl_unit_kerja')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_pegawai', function (Blueprint $table) {
            //
        });
    }
}
