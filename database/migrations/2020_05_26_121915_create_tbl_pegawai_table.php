<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pegawai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pns_id', 32);
            $table->string('nip_baru', 18);
            $table->string('nip_lama', 10);
            $table->string('nama');
            $table->string('gelar_depan');
            $table->string('gelar_belakang');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->string('nik', 50)->nullable();
            $table->string('nomor_hp', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->text('alamat')->nullable();
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
        Schema::dropIfExists('tbl_pegawai');
    }
}
